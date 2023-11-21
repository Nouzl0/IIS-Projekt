<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

use App\Models\Vozidlo;
use App\Models\Udrzba;
use App\Models\ZaznamUdrzby;
use App\Models\Uzivatel;

class OrganizeMaintenanceListRequests extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $maintenances;

    /* FUNCTIONS */

    /* maintenanceGetAll()
    DESCRIPTION:    - Function which gets all the maintenances from the database and formats them
                    - Returns an array of maintenances
    */
    private function maintenanceGetAll()
    {
        // Retrieve all maintenance records from the database
        $dbMaintenances = DB::table('udrzba')->get()->where('stav', '=', 'Vytvorená')->values()->toArray();
        
        // Initialize an empty array to store maintenance data
        $maintenances = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbMaintenances as $dbMaintenance) {

            // Format the maintenance data
            $maintenances[] = [
                'maintenanceId' => $dbMaintenance->id_udrzba,
                'spz' => $dbMaintenance->spz,
                'maintenanceName' => $dbMaintenance->nazov_spravy,
                'maintenanceDescription' => $dbMaintenance->popis,
            ];
        }
    
        return $maintenances;
    }


    /* maintenanceAdd()
    DESCRIPTION:    - Prepare Adding a maintenance to the database
    */

    public function maintenanceImport($maintenanceId) {
        $this->dispatch('maintenances-add-import', maintenanceId: $maintenanceId);
    }



    /* maintenanceDelete()
    DESCRIPTION:    - Deletes a maintenance from the database
                    - Dispatches an event to component 'OrganizeMaintenanceListRequests' to refresh the user's list
    */
    public function maintenanceDelete($maintenanceId) 
    {
        // delete user from DB
        DB::table('zaznam_udrzby')->where('id_udrzba', '=', $maintenanceId)->delete();
        DB::table('udrzba')->where('id_udrzba', '=', $maintenanceId)->delete();

        // send a message & refresh list
        $this->dispatch('refresh-maintenances-list-active')->to(OrganizeMaintenanceListRequests::class);
        $this->dispatch('alert-success', message: "Údržba bola odstránená z databázy");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-maintenances-list-requests')]
    public function mount() {

        // Get all maintenances from the database
        $this->maintenances = $this->maintenanceGetAll();

    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.organize-maintenance-list-requests');
    }
}
