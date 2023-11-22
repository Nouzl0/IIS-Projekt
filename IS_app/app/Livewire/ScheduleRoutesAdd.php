<?php

namespace App\Livewire;

use App\Models\PlanovanySpoj;
use DateTime;
use Livewire\Component;
use App\Models\Trasa;

class ScheduleRoutesAdd extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $scheduledRoutes;
    public $linkRoutes = [];
    public $repeatTypes = ['Nikdy', 'Denne'];
    public $vehicles = [];

    /* Input field properties */
    public $scheduledRoute;
    public $scheduledDate; 
    public $scheduledTime;
    public $scheduledRepeat;
    public $scheduledValidUntil; 
    //public $scheduledVehicle;


    /* FUNCTIONS */

    /* scheduleGetLinkRoute()
    DESCRIPTION:    - Function which gets all the Routes&Links from the database and formats them
                    - Returns an array of scheduledRoutes
                    - Given data will be used for select input field
    */
    private function scheduleGetLinkRoutes()
    {
        // Retrieve all routes with additional information about the line from the database
        $dbLinkRoutes = Trasa::select(
            'trasa.*',
            'linka.cislo_linky',
            'linka.vozidla_linky'
        )
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->get()
        ->toArray();
        
        // Initialize an empty array to store the formatted data for the view
        //$linkRoutes = [];
        
        // Loop through each route and format the data
        foreach ($dbLinkRoutes as $dbLinkRoute) {
            $this->linkRoutes[] = [
                'routeId' => $dbLinkRoute['id_trasa'],
                'linkName' => $dbLinkRoute['cislo_linky'],
                'routeName' => $dbLinkRoute['meno_trasy'],
            ];
        }

        //$this->vehicles = Vozidlo::all();

        //return $linkRoutes;
    }

    /* schedueleAdd()
    DESCRIPTION:    - This method adds a new planned route to the database based on the inputs from the user
    */
    public function scheduleAdd() 
    {   
        // Check if the input fields aren't empty
        try { 
            $validatedData = $this->validate([
                'scheduledRoute' => 'required|string',
                'scheduledDate' => 'required|string',
                'scheduledTime' => 'required|string',
                'scheduledRepeat' => 'required|string',
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

        // Build start of the planned route from selected date and time
        $zaciatok_trasy = $this->scheduledDate . ' ' . $this->scheduledTime . ':00';

        // Build valid until date and time, and format it
        $platny_do = new DateTime($this->scheduledValidUntil);
        $platny_do = $platny_do->format('Y-m-d H:i:s');

        //Create new planned route in the database 
        PlanovanySpoj::create(['id_trasa' => $this->scheduledRoute, 'zaciatok_trasy' => $zaciatok_trasy, 'opakovanie' => $this->scheduledRepeat, 'platny_do' => $platny_do]);

        // toggleoff edit, dispatch event and display success message
        $this->reset(['scheduledRoute', 'scheduledDate', 'scheduledTime', 'scheduledRepeat', 'scheduledValidUntil']);
        $this->dispatch('refresh-scheduled-list-edit')->to(ScheduleRoutesListEdit::class);
        $this->dispatch('alert-success', message: "Plánovaný spoj bol úspešne aktualizovaný");
    }

    
    /* LIVEWIRE */

    /* - TODO - Add description */
    public function mount() {

        // (select) get all link & routes
        $this->scheduleGetLinkRoutes();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.schedule-routes-add');
    }
}
