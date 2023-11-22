<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ScheduleRoutesListHistory extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $scheduledRoutes;

    
    /* FUNCTIONS */

    /* maintenanceGetAll()
    DESCRIPTION:    - Function which gets all the ScheduledRoutes from the database and formats them
                    - Returns an array of scheduledRoutes

    TODO:           - Get all scheduledRoutes from the database which are in the past
                    - Get additional information about the scheduled route
                    - Format the scheduledRoute data
    */
    private function maintenanceGetAll()
    {
        // Retrieve all maintenance records from the database
        $dbScheudledRoutes = [1]; // TODO - get all scheduled routes from the database filer by date (in the past)
        
        // Initialize an empty array to store maintenance data
        $scheduledRoutes = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbScheudledRoutes as $dbScheudledRoute) {

            // TODO - get additional information about the scheduled route

            // TODO - format the maintenance data 
            $scheduledRoutes[] = [
                'id' => "N/A",
                'link' => "N/A",
                'name' => "N/A",
                'start' => "N/A",
                'repeat' => "N/A",
                'validUntil' => "N/A",
                'driver' => "N/A",
            ];
        }
        return $scheduledRoutes;
    }
    
    /* maintenanceDelete()
    DESCRIPTION:    - Deletes a scheduledRoute from the database's history
                    - Refresh the the list itself
    
    TODO:           - Delete the scheduledRoute from the database
    */
    public function maintenanceDelete($scheduledRouteId) {
        
        // TODO - delete user from DB


        // send a message & refresh list
        $this->dispatch('refresh-scheduled-list-history')->to(ScheduleRoutesListHistory::class);
        $this->dispatch('alert-success', message: "Plánovaný spoj odstránený z histórie");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-scheduled-list-history')]
    public function mount() {
        // Get all maintenances from the database
        $this->scheduledRoutes = $this->maintenanceGetAll();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.schedule-routes-list-history');
    }
}
