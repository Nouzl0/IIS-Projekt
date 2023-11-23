<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PlanovanySpoj;
use App\Models\Uzivatel;
use App\Models\Vozidlo;

class AssignVehiclesListHistory extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $scheduledRoutes;

    
    /* FUNCTIONS */

    /* maintenanceGetAll()
    DESCRIPTION:    - Function which gets all the ScheduledRoutes from the database and formats them
                    - Returns an array of scheduledRoutes
    */
    private function maintenanceGetAll()
    {
        // Retrieve all scheduled routes records from the database with additional information about the line and route
        $dbScheduledRoutes = PlanovanySpoj::select(
            'planovany_spoj.*',
            'trasa.meno_trasy',
            'linka.cislo_linky',
        )
        ->join('trasa', 'planovany_spoj.id_trasa', '=', 'trasa.id_trasa')
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->where('planovany_spoj.platny_do', '<', date('Y-m-d H:i:s'))
        ->get()
        ->toArray();
        
        // Initialize an empty array to store maintenance data
        $scheduledRoutes = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbScheduledRoutes as $dbScheduledRoute) {

            // Get and format the information about the driver for the view
            $dbDriver = Uzivatel::where('uzivatel.id_uzivatel', '=', $dbScheduledRoute['id_uzivatel_sofer'])->first();
            if (is_null($dbDriver)) {
                $dbDriver = 'Nie je priradený';
            } else {
                $dbDriver = $dbDriver->toArray();
                $dbDriver = $dbDriver['meno_uzivatela'] . ' ' . $dbDriver['priezvisko_uzivatela'] . ' - ' . $dbDriver['email_uzivatela'];
            }

            // Get and format the information about the vehicle for the view
            $dbVehicle = Vozidlo::where('vozidlo.id_vozidlo', '=', $dbScheduledRoute['id_vozidlo'])->first();
            if (is_null($dbVehicle)) {
                $dbVehicle = 'Nie je priradené';
            } else {
                $dbVehicle = $dbVehicle->toArray();
                $dbVehicle = $dbVehicle['spz'] . ' - ' . $dbVehicle['druh_vozidla'];
            }

            // Format the scheduled routes data for the view
            $scheduledRoutes[] = [
                'id' => $dbScheduledRoute['id_plan_trasy'],
                'link' => $dbScheduledRoute['cislo_linky'],
                'name' => $dbScheduledRoute['meno_trasy'],
                'start' => $dbScheduledRoute['zaciatok_trasy'],
                'repeat' => $dbScheduledRoute['opakovanie'],
                'validUntil' => $dbScheduledRoute['platny_do'],
                'driver' => $dbDriver,
                'vehicle' => $dbVehicle,
            ];
        }
        return $scheduledRoutes;
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('assign-vehicles-list-history')]
    public function mount() {
        // Get all maintenances from the database
        $this->scheduledRoutes = $this->maintenanceGetAll();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.assign-vehicles-list-history');
    }
}
