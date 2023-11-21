<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

use App\Models\Vozidlo;
use App\Models\Udrzba;
use App\Models\ZaznamUdrzby;
use App\Models\Uzivatel;

class OrganizeMaintenanceListHistory extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $maintenances;

    /* Show button properties */
    public $showButton = false;
    public $showValue='';

    /* Input field properties */
    public $spz; 
    public $maintenanceId;
    public $maintenanceName;
    public $maintenanceState; 
    public $maintenanceDateTime;
    public $maintenanceFinishDateTime; 
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
        $dbMaintenances = DB::table('udrzba')->get()->where('stav', '=', 'Dokončená')->values()->toArray();
        
        // Initialize an empty array to store maintenance data
        $maintenances = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbMaintenances as $dbMaintenance) {

            // get the technician information directly with joins
            $technician = DB::table('zaznam_udrzby')
                ->join('uzivatel', 'zaznam_udrzby.id_uzivatel_technik', '=', 'uzivatel.id_uzivatel')
                ->where('zaznam_udrzby.id_udrzba', $dbMaintenance->id_udrzba)
                ->first();
            
            $recMeaintenances = DB::table('zaznam_udrzby')
                ->where('zaznam_udrzby.id_udrzba', $dbMaintenance->id_udrzba)
                ->get()->first();

            // Format the maintenance data
            $maintenances[] = [
                'maintenanceId' => $dbMaintenance->id_udrzba,
                'spz' => $dbMaintenance->spz,
                'maintenanceName' => $dbMaintenance->nazov_spravy,
                'maintenanceDateTime' => $dbMaintenance->zaciatok_udrzby,
                'maintenanceFinishDateTime' => $recMeaintenances->updated_at,
                'maintenanceTechnician' => $technician->meno_uzivatela . ' ' . $technician->priezvisko_uzivatela . ' - (' . $technician->email_uzivatela . ')',
                'maintenanceDescription' => $dbMaintenance->popis,
            ];
        }
        return $maintenances;
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
            $this->showValue = $maintenanceId;
        }
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
        $this->dispatch('refresh-maintenances-list-active')->to(OrganizeMaintenanceListHistory::class);
        $this->dispatch('alert-success', message: "Údržba bola odstránená z databázy");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-maintenances-list-active')]
    public function mount() {
        // Get all maintenances from the database
        $this->maintenances = $this->maintenanceGetAll();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.organize-maintenance-list-history');
    }
}
