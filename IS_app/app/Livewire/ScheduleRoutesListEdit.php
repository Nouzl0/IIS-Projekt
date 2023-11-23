<?php

namespace App\Livewire;

use App\Models\PlanovanySpoj;
use App\Models\Uzivatel;
use App\Models\Trasa;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use DateTime;

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
    */
    private function scheduleGetAll()
    {
        // Retrieve all scheduled routes records from the database with additional information about the line and route
        $dbScheduledRoutes = PlanovanySpoj::select(
            'planovany_spoj.*',
            'trasa.meno_trasy',
            'linka.cislo_linky',
        )
        ->join('trasa', 'planovany_spoj.id_trasa', '=', 'trasa.id_trasa')
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->where('planovany_spoj.platny_do', '>=', date('Y-m-d H:i:s'))
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

            // Format the scheduled routes data for the view
            $scheduledRoutes[] = [
                'id' => $dbScheduledRoute['id_plan_trasy'],
                'link' => $dbScheduledRoute['cislo_linky'],
                'name' => $dbScheduledRoute['meno_trasy'],
                'start' => $dbScheduledRoute['zaciatok_trasy'],
                'repeat' => $dbScheduledRoute['opakovanie'],
                'validUntil' => $dbScheduledRoute['platny_do'],
                'driver' => $dbDriver,
            ];
        }
        return $scheduledRoutes;
    }
    
    /* scheduleGetLinkRoute()
    DESCRIPTION:    - Function which gets all the Routes&Links from the database and formats them
                    - Returns an array of scheduledRoutes
                    - Given data will be used for select input field
    */
    private function scheduleGetLinkRoutes()
    {
        // Retrieve all routes from the database with additional information about the line
        $dbLinkRoutes = Trasa::select(
            'trasa.*',
            'linka.cislo_linky'
        )
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->get()
        ->toArray();
        
        // Initialize an empty array to store the formatted data
        $linkRoutes = [];
        
        // Loop through each route record and format the data for the view
        foreach ($dbLinkRoutes as $dbLinkRoute) {

            $linkRoutes[] = [
                'routeId' => $dbLinkRoute['id_trasa'],
                'linkName' => $dbLinkRoute['cislo_linky'],
                'routeName' => $dbLinkRoute['meno_trasy'],
            ];
        }
        return $linkRoutes;
    }
    
    /* maintenanceSave()
    DESCRIPTION:    - Function which validates and updates a schedules in the database
                    - Refreshes the list component
    */
    public function scheduleSave($scheduleId) 
    {   
        // Check if the input fields aren't empty and check their types
        try { 
            $validatedData = $this->validate([
                'scheduledRoute' => 'required|integer',
                'scheduledDate' => 'required|string',
                'scheduledTime' => 'required|string',
                'scheduledRepeat' => 'required|string',
            ], [
                'scheduledRoute.required'  => 'Trasa nie je vyplnená',
                'scheduledDate.required' => 'Dátum nie je vyplnený',
                'scheduledTime.required'=> ' Čas nie je vyplnený',
                'scheduledRepeat.required' => 'Opakovanie jazdy nie je vyplnené',
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

        // Build start of the planned route from the selected date and time
        $zaciatok_trasy = $this->scheduledDate . ' ' . $this->scheduledTime;

        // Build valid until date and time from the selected valid until date
        $platny_do = new DateTime($this->scheduledValidUntil);
        $platny_do = $platny_do->format('Y-m-d H:i:s');

        // Update the selected scheduled route with the inputted data
        PlanovanySpoj::where('id_plan_trasy', '=', $scheduleId)
                     ->update(['id_trasa' => $this->scheduledRoute, 'zaciatok_trasy' => $zaciatok_trasy, 'opakovanie' => $this->scheduledRepeat, 'platny_do' => $platny_do]);

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
            
            // Retrieve data about the selected scheduled route with additional information about the route and line
            $selectedScheduledRoute = PlanovanySpoj::select(
                'planovany_spoj.*',
                'trasa.meno_trasy',
                'trasa.id_trasa',
                'linka.cislo_linky'
            )
            ->join('trasa', 'planovany_spoj.id_trasa', '=', 'trasa.id_trasa')
            ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
            ->where('id_plan_trasy' ,'=', $scheduleId)
            ->first();

            // Format the date and time of the start
            $date_time_start = explode(' ', $selectedScheduledRoute->zaciatok_trasy);
            $date_start = $date_time_start[0];
            $time_start = $date_time_start[1];

            // Format the date of the valid until
            $date_time_valid_until = explode(' ', $selectedScheduledRoute->platny_do);
            $date_valid_until = $date_time_valid_until[0];

            // Fill the input fields with the selected planned route data
            if (is_null($selectedScheduledRoute)) {
                $this->scheduledRoute = "N/A";
                $this->scheduledDate = "N/A";
                $this->scheduledTime = "N/A";
                $this->scheduledRepeat = "N/A";
                $this->scheduledValidUntil = "N/A";
            } else {
                $this->scheduledRoute = $selectedScheduledRoute->id_trasa;
                $this->scheduledDate = $date_start;
                $this->scheduledTime = $time_start;
                $this->scheduledRepeat = $selectedScheduledRoute->opakovanie;
                $this->scheduledValidUntil = $date_valid_until;
            }
        }
    }
    
    /* scheduleDelete()
    DESCRIPTION:    - Deletes a scheduledRoute from the database's history
                    - Refresh the the list itself
    */
    public function scheduleDelete($scheduleId) {
        
        // Delete the selected planned route
        PlanovanySpoj::where('id_plan_trasy', '=', $scheduleId)->delete();

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
