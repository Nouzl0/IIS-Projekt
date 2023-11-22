<?php

namespace App\Livewire;

use Livewire\Component;

class ScheduleRoutesAdd extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $scheduledRoutes;
    public $linkRoutes;
    public $repeatTypes = ['Nikdy', 'Denne'];

    /* Input field properties */
    public $scheduledRoute;
    public $scheduledDate; 
    public $scheduledTime;
    public $scheduledRepeat;
    public $scheduledValidUntil; 


    /* FUNCTIONS */

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

    /* schedueleAdd()
    DESCRIPTION:    - xxx
    
    TODO:           - Add description
    */
    public function scheduleAdd($scheduleId) 
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


        // TODO - Create new schedule with the given id


        // toggleoff edit, dispatch event and display success message
        $this->reset(['scheduledRoute', 'scheduledDate', 'scheduledTime', 'scheduledRepeat', 'scheduledValidUntil']);
        $this->dispatch('refresh-scheduled-list-edit')->to(ScheduleRoutesListEdit::class);
        $this->dispatch('alert-success', message: "Plánovaný spoj bol úspešne aktualizovaný");
    }

    
    /* LIVEWIRE */

    /* - TODO - Add description */
    public function mount() {

        // (select) get all link & routes
        $this->linkRoutes = $this->scheduleGetLinkRoutes();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.schedule-routes-add');
    }
}
