<?php

namespace App\Livewire;

use App\Models\Udrzba;
use App\Models\Uzivatel;
use App\Models\ZaznamUdrzby;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\On;

class RecordMaintenanceList extends Component
{
    public $user;                           // information from DB about the currently logged user
    public $assigned_maintenances;          // all assigned maintenances from the DB

    public $show_description = false;       // show or don't show the description for the selected maintenance in the view
    public $show_description_value = '';    // description for the selected maintenance in the view

    /**
     * This method updates the $show_description property for the view
     */
    public function showDescription($id) 
    {
        if ($this->show_description && $this->show_description_value === $id) {
            // If the button is already in show mode, turn it off
            $this->show_description = false;
            $this->show_description_value = '';
        } else {
            // If the button is not in edit mode or is in show mode
            $this->show_description = true;
            $this->show_description_value = $id;
        }
    }

    /**
     * This method retrieves all assigned maintenances from the DB for the currently logged user
     */
    private function getAllAssignedMaintenances()
    {
        // Get information about the logged user
        $this->user = Uzivatel::where('email_uzivatela', '=', session('userEmail'))->first();

        // Get the currently logged user's assigned maintenances
        $assigned_maintenances_db = ZaznamUdrzby::select(
            'zaznam_udrzby.id_udrzba',
            'zaznam_udrzby.id_uzivatel_technik',
            'udrzba.*'
        )
        ->join('udrzba', 'zaznam_udrzby.id_udrzba', '=', 'udrzba.id_udrzba')
        ->where('zaznam_udrzby.id_uzivatel_technik', '=', $this->user->id_uzivatel)
        ->where('udrzba.stav', '=', 'Priradená')
        ->get();

        // Initialize an empty array to store assigned maintenances
        $assigned_maintenances = [];

        // Loop through each assigned maintenances from DB and format the data
        foreach ($assigned_maintenances_db as $assigned_maintenance_db) {
            $assigned_maintenances[] = [
                'id_udrzba' => $assigned_maintenance_db->id_udrzba,
                'id_vozidlo' => $assigned_maintenance_db->id_vozidlo,
                'nazov_spravy' => $assigned_maintenance_db->nazov_spravy,
                'spz' => $assigned_maintenance_db->spz,
                'stav' => $assigned_maintenance_db->stav,
                'popis' => $assigned_maintenance_db->popis,
            ];
        }

        return $assigned_maintenances;
    }

    /**
     * This method updates the specific maintenance in the Udrzba table and refreshes the record list
     */
    public function updateMaintenance($id_udrzba)
    {
        try {
            Udrzba::where('id_udrzba', '=', $id_udrzba)->update(['stav' => 'Dokončená']);
            $this->dispatch('refresh-maintenance-record-list')->to(RecordMaintenanceList::class);         // refresh maintenance record list
        } catch (QueryException $e) {
            $this->dispatch('alert-error', message: "Nepodarilo sa dokončiť údržbu. Skúste to znova zachvíľu, poprípade kontaktujte správcu.");  // send error message
        }
    }

    /* - Used for mounting the component, with listener to refresh the list */
    #[On('refresh-maintenance-record-list')]
    public function mount()
    {
        // Set the $assigned_maintenances property with the formatted assigned_maintenances array
        $this->assigned_maintenances = $this->getAllAssignedMaintenances();
    }
    
    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.record-maintenance-list');
    }
}
