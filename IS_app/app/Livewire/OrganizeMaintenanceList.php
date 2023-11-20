<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

use App\Models\Vozidlo;
use App\Models\Udrzba;
use App\Models\ZaznamUdrzby;
use App\Models\Uzivatel;

class OrganizeMaintenanceList extends Component
{

    /* ATRIBUTES */

    /* All data property */
    public $maintenances;

    /* Edit button properties */
    public $editButton = false;
    public $editValue='';

    /* Input field properties */
    public $spz; 
    public $maintenanceId;
    public $maintenanceName;
    public $maintenanceState; 
    public $maintenanceDate;
    public $maintenanceTime; 
    public $maintenanceTechnician;
    public $maintenanceDescription;


    /* FUNCTIONS */

    /* maintenanceGetAll()
    DESCRIPTION:    - Function which gets all the maintenances from the database and formats them
                    - Returns an array of maintenances
    */
    private function maintenanceGetAll()
    {
        // Retrieve all maintenance records from the database
        $dbMaintenances = DB::table('udrzba')->get()->toArray();
        
        // Initialize an empty array to store maintenance data
        $maintenances = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbMaintenances as $dbMaintenance) {
            // get date and time from datetime db-value
            $datetime = explode(" ", $dbMaintenance->zaciatok_udrzby);
    
            // get the technician information directly with joins
            $technician = DB::table('zaznam_udrzby')
                ->join('uzivatel', 'zaznam_udrzby.id_uzivatel_technik', '=', 'uzivatel.id_uzivatel')
                ->where('zaznam_udrzby.id_udrzba', $dbMaintenance->id_udrzba)
                ->first();
    
            // Format the maintenance data
            $maintenances[] = [
                'maintenanceId' => $dbMaintenance->id_udrzba,
                'spz' => $dbMaintenance->spz,
                'maintenanceName' => "N/A", //$dbMaintenance->nazov,
                'maintenanceTime' => $datetime[1],
                'maintenanceDate' => $datetime[0],
                'maintenanceTechnician' => $technician->meno_uzivatela . ' ' . $technician->priezvisko_uzivatela . ' - (' . $technician->email_uzivatela . ')',
                'maintenanceDescription' => $dbMaintenance->popis,
            ];
        }
    
        return $maintenances;
    }
    
    /* maintenanceSave()
    DESCRIPTION:    - Function which validates and updates a maintenance in the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManageMaintenancesList' to refresh the user's list
    */
    public function maintenanceSave($maintenancesId) {
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'maintenanceName' => 'required|string',
                'spz' => 'required|string|exists:vozidlo,spz',
                'maintenanceDescription' => 'required|string',
                'maintenanceTime' => 'required|string|time',
                'maintenanceDate' => 'required|string|date',
                'maintenanceTechnician' => 'required|string|exists:uzivatel,login',
            ], [
                'maintenanceName.required' => 'Meno údržby nie je vyplnené',
                'spz.required' => 'ŠPZ nie je vyplnená',
                'spz.exists' => 'Vozidlo so zadanou ŠPZ neexistuje',
                'maintenanceDescription.required' => 'Popis údržby nie je vyplnený',
                'maintenanceTime.required' => 'Čas údržby nie je vyplnený',
                'maintenanceTime.time' => 'Čas údržby nie je v zlom formáte',
                'maintenanceDate.required' => 'Dátum údržby nie je vyplnený',
                'maintenanceDate.date' => 'Dátum údržby nie je v zlom formáte',
                'maintenanceTechnician.required' => 'Technik údržby nie je vyplnený',
                'maintenanceTechnician.exists' => 'Zadaný technik neexistuje',
            ]);

        // If validation fails, exception is caught and then is displayed error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
            return;

        // If there is any other exception, display basic error message
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Input validation failed");
            return;
        }

            // Update the maintenance with the given id
            Udrzba::where('id_udrzba', $maintenancesId)->update([
                'spz' => $validatedData['spz'],
                'nazov' => $validatedData['maintenanceName'],
                'zaciatok_udrzby' => $validatedData['maintenanceTime'] . ' ' . $validatedData['maintenanceDate'],
                'stav' => "Naplanovaná",
                'popis' => $validatedData['maintenanceDescription'],
            ]);

            // update maintenance record with the given technician-id
            $id_technik = Uzivatel::where('email', $validatedData['maintenanceTechnician'])->first()->id_uzivatel;
            ZaznamUdrzby::where('id_udrzba', $maintenancesId)->update([
                'id_uzivatel_technik' => $id_technik->id_uzivatel_technik,
            ]);

            // toggleoff edit, dispatch event and display success message
            $this->editButton = false;
            $this->dispatch('refresh-maintenances-list')->to(ManageMaintenancesList::class);
            $this->dispatch('alert-success', message: "Vozidlo bolo úspešne aktualizované");
    }

    /* maintenanceEdit()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function maintenanceEdit($maintenanceId)
    {
        if ($this->editButton && $this->editValue === $maintenanceId) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->editButton = true;
            $this->editValue = $maintenanceId;
            
            // Get the needed data from the database
            $maintenance = DB::table('vozidlo')->where('spz', '=', $maintenanceId)->first();
            [$date, $time] = explode(" ", $maintenance->zaciatok_udrzby);
            $recordedMaintenance = DB::table('zaznam_udrzby')->where('id_udrzba', '=', $maintenance->id_udrzba)->first();
            $technician = DB::table('uzivatel')->where('id_uzivatel', '=', $recordedMaintenance->id_uzivatel)->first();

            // Fill the input fields with the current user data
            $this->maintenanceId = $maintenance->id_udrzba;
            $this->spz = $maintenance->spz;
            $this->maintenanceName = $maintenance->nazov;
            $this->maintenanceDate = $date;
            $this->maintenanceTime = $time; 
            $this->maintenanceTechnician = $technician->meno_uzivatela . ' ' . $technician->priezvisko_uzivatela . ' ' . $technician->email_uzivatela;
            $this->maintenanceDescription = $maintenance->popis;
        }
    }
    
    /* maintenanceDelete()
    DESCRIPTION:    - Deletes a maintenance from the database
                    - Dispatches an event to component 'OrganizeMaintenanceList' to refresh the user's list
    */
    public function maintenanceDelete($maintenaceId) {
        
        // delete user from DB
        DB::table('udrzba')->where('id_udrzba', '=', $maintenaceId)->delete();

        // send a message & refresh list
        $this->dispatch('refresh-maintenances-list')->to(OrganizeMaintenanceList::class);
        $this->dispatch('alert-success', message: "Údržba bola odstránená z databázy");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-maintenances-list')]
    public function mount() {

        // Get all maintenances from the database
        $this->maintenances = $this->maintenanceGetAll();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.organize-maintenance-list');
    }
}
