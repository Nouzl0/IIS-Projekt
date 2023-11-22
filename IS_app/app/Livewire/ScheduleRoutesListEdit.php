<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ScheduleRoutesListEdit extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $scheduledRoutes;
    public $linkRoutes;
    public $repeatTypes = ['Nikdy', 'Denne'];

    /* Edit button properties */
    public $editButton = false;
    public $editValue='';

    /* Input field properties */
    public $scheduledRoute;
    public $scheduledDate; 
    public $scheduledTime;
    public $scheduledRepeat;
    public $scheduledValidUntil; 

    /* FUNCTIONS */

    /* maintenanceGetAll()
    DESCRIPTION:    - Function which gets all the ScheduledRoutes from the database and formats them
                    - Returns an array of scheduledRoutes
    
    TODO:           - Get all scheduledRoutes from the database which are NOT in the past
                    - Get additional information about the scheduled route
                    - Format the scheduledRoute data
    */
    private function scheduleGetAll()
    {
        // Retrieve all maintenance records from the database
        $dbScheudledRoutes = [1]; // TODO - get all scheduled routes from the database filer by date (in the past)
        
        // Initialize an empty array to store maintenance data
        $scheduledRoutes = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbScheudledRoutes as $dbScheudledRoute) {

            // TODO - get additional information about the scheduled route

            // TODO - format the maintenance data (replace the 'N/A' values)
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
    
    /* scheduleGetLinkRoute()
    DESCRIPTION:    - Function which gets all the Routes&Links from the database and formats them
                    - Returns an array of scheduledRoutes
                    - Given data will be used for select input field
    
    TODO:           - Get all scheduledRoutes from the database which are NOT in the past
                    - Get additional information about the scheduled route
                    - Format the scheduledRoute data
    */
    private function scheduleGetLinkRoutes()
    {
        // Retrieve all maintenance records from the database
        $dbLinkRoutes = [1]; // TODO - get all routes from the database
        
        // Initialize an empty array to store maintenance data
        $linkRoutes = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbLinkRoutes as $dbLinkRoute) {

            // TODO - get additional information about the route -> linkName

            // TODO - format the maintenance data (replace the 'N/A' values)
            $linkRoutes[] = [
                'routeId' => "N/A",
                'linkName' => "N/A",
                'routeName' => "N/A",
            ];
        }
        return $linkRoutes;
    }
    
    /* maintenanceSave()
    DESCRIPTION:    - Function which validates and updates a schedules in the database
                    - Refreshes the list component
    
    TODO:           - Validate the input fields, if needed add other checks
                    - Update the schedule with the given id
    */
    public function scheduleSave($scheduleId) 
    {   
        // Check if the input fields aren't empty
        try { 
            // TODO - Validate input fields with custom error messages
            $validatedData = $this->validate([
                'scheduledRoute' => 'reqired|string',
                'scheduledDate' => 'reqired|string',
                'scheduledTime' => 'reqired|string',
                'scheduledRepeat' => 'reqired|string',
            ], [
                'scheduledRoute.required'  => 'Trasa nie je vyplnené',
                'scheduledDate.required' => 'Dátum nie je vyplnený',
                'scheduledTime.required'=> ' Čas nie je vyplnený',
                'scheduledRepeat.required' => 'Opakvanie jazdy nie je vyplnené',
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

        // TODO - add other checks


        // TODO - Update the maintenance with the given id


        // toggleoff edit, dispatch event and display success message
        $this->editButton = false;
        $this->dispatch('refresh-scheduled-list-edit')->to(ScheduleRoutesListEdit::class);
        $this->dispatch('alert-success', message: "Plánovaný spoj bol úspešne aktualizovaný");
    }

    /* scheduleEdit()
    DESCRIPTION:    - Function which toggles the edit option for a schedules (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function scheduleEdit($scheduleId)
    {
        if ($this->editButton && $this->editValue === $scheduleId) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->editButton = true;
            $this->editValue = $scheduleId;
            
            // TODO - Get data about the scheduled route from the database

            // TODO - Fill the input fields with the data (replace the 'N/A' values)
            $this->scheduledRoute = "N/A";
            $this->scheduledDate = "N/A";
            $this->scheduledTime = "N/A";
            $this->scheduledRepeat = "N/A";
            $this->scheduledValidUntil = "N/A";
        }
    }
    
    /* scheduleDelete()
    DESCRIPTION:    - Deletes a scheduledRoute from the database's history
                    - Refresh the the list itself
    
    TODO:           - Delete the scheduledRoute from the database
    */
    public function scheduleDelete($scheduleId) {
        
        // TODO - delete user from DB

        // send a message & refresh list
        $this->dispatch('refresh-scheduled-list-edit')->to(ScheduleRoutesListEdit::class);
        $this->dispatch('alert-success', message: "Plánovaný spoj odstránený z histórie");
    }

    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-scheduled-list-edit')]
    public function mount() {

        // Get all maintenances from the database
        $this->scheduledRoutes = $this->scheduleGetAll();

        // (select) get all link & routes
        $this->linkRoutes = $this->scheduleGetLinkRoutes();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.schedule-routes-list-edit');
    }
}
