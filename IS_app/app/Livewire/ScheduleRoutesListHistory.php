<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\PlanovanySpoj;
use App\Models\Uzivatel;
use App\Models\Vozidlo;

class ScheduleRoutesListHistory extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $scheduledRoutes;

    
    /* FUNCTIONS */

    /* scheduledRoutesGetExpired()
    DESCRIPTION:    - Function which gets all the ScheduledRoutes from the database and formats them
                    - Returns an array of scheduledRoutes
    */
    private function scheduledRoutesGetExpired()
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

            // Format Vehicle ID for the view
            $dbVehicleInfo = Vozidlo::where('id_vozidlo', $dbScheduledRoute['id_vozidlo'])->first(['spz']);
            if (is_null($dbVehicleInfo)) {
                $dbVehicleInfo = 'Nie je priradené';
            } else {
                $dbVehicleInfo = $dbVehicleInfo->spz;
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
                'vehicle' => $dbVehicleInfo
            ];
        }
        return $scheduledRoutes;
    }
    
    /* scheduledRoutesDeleteExpired()
    DESCRIPTION:    - Deletes a scheduledRoute from the database's history
                    - Refresh the the list itself
    */
    public function scheduledRoutesDeleteExpired($scheduledRouteId) 
    {
        // Delete the selected planned route
        PlanovanySpoj::where('id_plan_trasy', '=', $scheduledRouteId)->delete();

        // send a message & refresh list
        $this->dispatch('refresh-scheduled-list-history')->to(ScheduleRoutesListHistory::class);
        $this->dispatch('alert-success', message: "Plánovaný spoj odstránený z histórie");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-scheduled-list-history')]
    public function mount() 
    {
        // Get all maintenances from the database
        $this->scheduledRoutes = $this->scheduledRoutesGetExpired();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.schedule-routes-list-history');
    }
}
