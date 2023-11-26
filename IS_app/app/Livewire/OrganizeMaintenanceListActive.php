<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

use App\Models\Vozidlo;
use App\Models\Udrzba;
use App\Models\ZaznamUdrzby;
use App\Models\Uzivatel;
use App\Models\PlanovanySpoj;

class OrganizeMaintenanceListActive extends Component
{

    /* ATRIBUTES */

    /* All data property */
    public $maintenances;
    public $technicians;
    public $vehicles;

    /* Edit button properties */
    public $editButton = false;
    public $editValue='';

    /* Show button properties */
    public $showButton = false;
    public $showValue='';

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
        $dbMaintenances = DB::table('udrzba')->get()->where('stav', '=', 'Priradená')->values()->toArray();
        
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
                'maintenanceName' => $dbMaintenance->nazov_spravy,
                'maintenanceDate' => $datetime[0],
                'maintenanceTime' => $datetime[1],
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
    public function maintenanceSave($maintenancesId) 
    {
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'maintenanceName' => 'required|string',
                'spz' => 'required|string|exists:vozidlo,spz',
                'maintenanceDescription' => 'required|string',
                'maintenanceTime' => 'required|string',
                'maintenanceDate' => 'required|string',
                'maintenanceTechnician' => 'required|exists:uzivatel,id_uzivatel',
            ], [
                'maintenanceName.required' => 'Meno údržby nie je vyplnené',
                'spz.required' => 'ŠPZ nie je vyplnená',
                'spz.exists' => 'Vozidlo so zadanou ŠPZ neexistuje',
                'maintenanceDescription.required' => 'Popis údržby nie je vyplnený',
                'maintenanceTime.required' => 'Čas údržby nie je vyplnený',
                'maintenanceDate.required' => 'Dátum údržby nie je vyplnený',
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
            'zaciatok_udrzby' => $validatedData['maintenanceDate'] . " " . $validatedData['maintenanceTime'],
            'nazov_spravy' => $validatedData['maintenanceName'],
            'spz' => $validatedData['spz'],
            'stav' => "Priradená",
            'popis' => $validatedData['maintenanceDescription']
        ]);

        // update maintenance record with the given technician-id
        ZaznamUdrzby::where('id_udrzba', $maintenancesId)->update([
            'id_uzivatel_technik' => $validatedData['maintenanceTechnician'],
        ]);


        // check if the vehicle is in any scheduled routes & get all scheduled-routes with the given vehicle from the database
        $vozidlo = Vozidlo::where('spz', $validatedData['spz'])->first();
        $scheduledRoutes = PlanovanySpoj::where('id_vozidlo', $vozidlo->id_vozidlo)
            ->whereNotNull('id_vozidlo')
            ->get();  // Use get() to retrieve the results

        // if there are scheduled routes with the given vehicle, update them
        if ($scheduledRoutes->isNotEmpty()) {
            foreach ($scheduledRoutes as $scheduledRoute) {
                PlanovanySpoj::where('id_plan_trasy', $scheduledRoute->id_plan_trasy)->update([
                    'id_vozidlo' => null,
                    'id_uzivatel_sofer' => null,
                ]);
            }
            // display success message with additional information
            $this->dispatch('alert-success', message: "Plán údržby bol úspešne aktualizovaný a vozidlo bolo odstránené zo všetkých plánovaných spojov, ktoré mu boli priradené.");
        
        // display default success message
        } else {
            $this->dispatch('alert-success', message: "Údržba bola úspešne aktualizované");
        }

        // toggleoff edit, dispatch event and display success message
        $this->editButton = false;
        $this->dispatch('refresh-maintenances-list-active')->to(OrganizeMaintenanceListActive::class);
    }

    /* maintenanceEdit()
    DESCRIPTION:    - Function which toggles the edit option for a maintenance (UI)
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
            $this->showButton = false;
            $this->editValue = $maintenanceId;
            

            // Get the needed data from the database
            $maintenance = DB::table('udrzba')->where('id_udrzba', '=', $maintenanceId)->first();
            $datetime = explode(" ", $maintenance->zaciatok_udrzby);
            $recordedMaintenance = DB::table('zaznam_udrzby')->where('id_udrzba', '=', $maintenance->id_udrzba)->first();

            // Fill the input fields with the current user data
            $this->maintenanceId = $maintenance->id_udrzba;
            $this->spz = $maintenance->spz;
            $this->maintenanceName = $maintenance->nazov_spravy;
            $this->maintenanceDate = $datetime[0];
            $this->maintenanceTime = $datetime[1]; 
            $this->maintenanceTechnician = $recordedMaintenance->id_uzivatel_technik;
            $this->maintenanceDescription = $maintenance->popis;
        }
    }

    /* maintenanceShow()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function maintenanceShow($maintenanceId)
    {
        if ($this->showButton && $this->showValue === $maintenanceId) {
            // If the button is already in edit mode for the current user, turn it off
            $this->showButton = false;
            $this->showValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->showButton = true;
            $this->editButton = false;
            $this->showValue = $maintenanceId;
        }
        //dd($maintenanceId, $this->showButton, $this->showValue);
    }    
    
    /* maintenanceDelete()
    DESCRIPTION:    - Deletes a maintenance from the database
                    - Dispatches an event to component 'OrganizeMaintenanceListActive' to refresh the user's list
    */
    public function maintenanceDelete($maintenaceId) {
        
        // delete user from DB
        DB::table('zaznam_udrzby')->where('id_udrzba', '=', $maintenaceId)->delete();
        DB::table('udrzba')->where('id_udrzba', '=', $maintenaceId)->delete();

        // send a message & refresh list
        $this->dispatch('refresh-maintenances-list-active')->to(OrganizeMaintenanceListActive::class);
        $this->dispatch('alert-success', message: "Údržba bola odstránená z databázy");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-maintenances-list-active')]
    public function mount() {

        // Get all maintenances from the database
        $this->maintenances = $this->maintenanceGetAll();

        // (select) get all the vehicles
        $this->vehicles = Vozidlo::all();

        $this->technicians = Uzivatel::where('rola_uzivatela', 'technik')
            ->orWhere('rola_uzivatela', 'administrátor')
            ->get(['id_uzivatel', 'meno_uzivatela', 'priezvisko_uzivatela', 'email_uzivatela']);
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.organize-maintenance-list-active');
    }
}
