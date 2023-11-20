<?php

namespace App\Livewire;

use Livewire\Component;

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

        // Find the vehicle with the given spz
        $vozidlo = Vozidlo::where('spz', $validatedData['spz'])->first();
        
        // Create new mainenance model:Udrzba amd get created udrzba id
        $udrzba = Udrzba::create([
            'zaciatok_udrzby' => $validatedData['maintenanceDate'] . " " . $validatedData['maintenanceTime'],
            'id_vozidlo' => $vozidlo->id_vozidlo, 
            //'meno' => $validatedData['maintenanceName'], add when it is in database
            'spz' => $validatedData['spz'], 
            'stav' => 'Vytvorená', 
            'popis' => $validatedData['maintenanceDescription']
        ]);
        
        // Create new maintenance record model:ZaznamUdrzby
        ZaznamUdrzby::create([
            'id_udrzba' => $udrzba->id_udrzba,
            'id_uzivatel_technik' => $validatedData['maintenanceTechnician'],
        ]);

        // show success message and reset fields
        $this->dispatch('refresh-maintenances-list')->to(OrganizeMaintenanceList::class);
        $this->reset(['maintenanceName', 'spz', 'maintenanceDescription', 'maintenanceTime', 'maintenanceDate', 'maintenanceTechnician']);
        $this->dispatch('alert-success', message: "Plán údržby bol úspešne vytvorený.");
    }

    
    /* LIVEWIRE */

    /* - TODO - Add description */
    public function mount() {
        $this->vehicles = Vozidlo::all();
        $this->technicians = Uzivatel::where('rola_uzivatela', "technik")->get(['id_uzivatel', 'meno_uzivatela', 'priezvisko_uzivatela', 'email_uzivatela']);
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.organize-maintenance-add');
    }
}
