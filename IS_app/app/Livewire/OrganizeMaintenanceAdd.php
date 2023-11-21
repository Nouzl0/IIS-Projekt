<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Vozidlo;
use App\Models\Uzivatel;
use App\Models\Udrzba;
use App\Models\ZaznamUdrzby;

class OrganizeMaintenanceAdd extends Component
{
    /* ATTRIBUTES */

    /* data properties */
    public $vehicles;
    public $technicians;

    /* field properties*/
    public $maintenanceName;
    public $spz;
    public $maintenanceDescription;
    public $maintenanceTime;
    public $maintenanceDate;
    public $maintenanceTechnician;

    public $importMode = false;
    public $importValue = '';

    /* FUNCTIONS */

    /* addMaintenance()
    DESCRIPTION:    - xxx
    
    TODO:           - Add description
    */
    public function addMaintenance()
    {
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'maintenanceName' => 'required|string',
                'spz' => 'required|string|exists:vozidlo,spz',
                'maintenanceDescription' => 'required|string',
                'maintenanceTime' => 'required|string',
                'maintenanceDate' => 'required|string',
                'maintenanceTechnician' => 'required|string|exists:uzivatel,id_uzivatel',
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

        
        // Importing from requests
        if($this->importMode) {

            // Find the vehicle with the given spz
            $vozidlo = Vozidlo::where('spz', $validatedData['spz'])->first();

            // Find the record by 'id_udrzba' and update its values
            Udrzba::where('id_udrzba', $this->importValue)->update([
                'zaciatok_udrzby' => $validatedData['maintenanceDate'] . " " . $validatedData['maintenanceTime'],
                'id_vozidlo' => $vozidlo->id_vozidlo,
                'nazov_spravy' => $validatedData['maintenanceName'],
                'spz' => $validatedData['spz'],
                'stav' => 'Priradená',
                'popis' => $validatedData['maintenanceDescription']
            ]);
            
            // Retrieve the updated record
            $udrzba = Udrzba::where('id_udrzba', $this->importValue)->first();
            
            // Create new maintenance record model: ZaznamUdrzby
            ZaznamUdrzby::create([
                'id_udrzba' => $udrzba->id_udrzba,
                'id_uzivatel_technik' => $validatedData['maintenanceTechnician'],
            ]);

            // change import mode to false
            $this->importMode = false;
            $this->importValue = '';

            // referesh list and show success message
            $this->dispatch('refresh-maintenances-list-requests')->to(OrganizeMaintenanceListRequests::class);

        // Creating new maintenance
        } else {

            // Find the vehicle with the given spz
            $vozidlo = Vozidlo::where('spz', $validatedData['spz'])->first();
            
            // Create new mainenance model:Udrzba amd get created udrzba id
            $udrzba = Udrzba::create([
                'zaciatok_udrzby' => $validatedData['maintenanceDate'] . " " . $validatedData['maintenanceTime'],
                'id_vozidlo' => $vozidlo->id_vozidlo, 
                'nazov_spravy' => $validatedData['maintenanceName'],
                'spz' => $validatedData['spz'], 
                'stav' => 'Priradená', 
                'popis' => $validatedData['maintenanceDescription']
            ]);

            // Create new maintenance record model:ZaznamUdrzby
            ZaznamUdrzby::create([
                'id_udrzba' => $udrzba->id_udrzba,
                'id_uzivatel_technik' => $validatedData['maintenanceTechnician'],
            ]);
            
            // refresh list
            $this->dispatch('refresh-maintenances-list-active')->to(OrganizeMaintenanceListActive::class);
        }

        // show success message and reset fields
        $this->reset(['maintenanceName', 'spz', 'maintenanceDescription', 'maintenanceTime', 'maintenanceDate', 'maintenanceTechnician']);
        $this->dispatch('alert-success', message: "Plán údržby bol úspešne vytvorený.");
    }


    /* importMaintenance()
    DESCRIPTION:    - Fills the input fields with data retrieved event
                    - 
    */
    #[On('maintenances-add-import')]
    public function importMaintenance($maintenanceId) {

        // set to default values
        if ($this->importMode & $maintenanceId == "-1") {
            $this->importMode = false;
            $this->importValue = '';
            $this->dispatch('alert-clear');
            $this->reset(['maintenanceName', 'spz', 'maintenanceDescription', 'maintenanceTime', 'maintenanceDate', 'maintenanceTechnician']);
        
        // set importMode to true
        } else {
            // Get maintenance data from database and fill the input fields
            $data = Udrzba::where('id_udrzba', $maintenanceId)->first();
            $this->maintenanceName = $data->nazov;
            $this->spz = $data->spz;
            $this->maintenanceDescription = $data->popis;
            $this->maintenanceName = $data->nazov_spravy;

            
            $this->importMode = true;
            $this->importValue = $maintenanceId;
            $this->dispatch('alert-success', message: "Doplnte ostatné údaje o údržbe");
        }
    }

    
    /* LIVEWIRE */

    /* - TODO - Add description */
    public function mount() {

        // (select) - get all vehicles
        $this->vehicles = Vozidlo::all();

        // (select) - get only technicians (final select will be chosen in the final version)
        // $this->technicians = Uzivatel::where('rola_uzivatela', "technik")->get(['id_uzivatel', 'meno_uzivatela', 'priezvisko_uzivatela', 'email_uzivatela']);
        // (select) - get technicians and admins
        $this->technicians = Uzivatel::where('rola_uzivatela', 'technik')
            ->orWhere('rola_uzivatela', 'administrátor')
            ->get(['id_uzivatel', 'meno_uzivatela', 'priezvisko_uzivatela', 'email_uzivatela']);
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.organize-maintenance-add');
    }
}
