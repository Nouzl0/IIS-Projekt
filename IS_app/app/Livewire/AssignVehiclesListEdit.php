<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\PlanovanySpoj;
use App\Models\Uzivatel;
use App\Models\Vozidlo;

class AssignVehiclesListEdit extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $scheduledRoutes;
    public $drivers;
    public $vehicles;

    /* Edit button properties */
    public $editButton = false;
    public $editValue='';

    /* Input field properties */
    public $scheduledDriver;
    public $scheduledVehicle;


    /* FUNCTIONS */

    /* maintenanceGetAll()
    DESCRIPTION:    - Function which gets all the ScheduledRoutes from the database and formats them
                    - Returns an array of scheduledRoutes
    */
    private function assignGetScheduledRoutes()
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
    
    /* assignGetDrivers()
    DESCRIPTION:    - Function which gets all driver (users) from the database and formats them
                    - Returns an array of drivers
                    - Given data will be used for select input field
    */
    private function assignGetDrivers()
    {
        // Retrieve all drivers from the database
        $dbDrivers = Uzivatel::where('rola_uzivatela', '=', 'vodič')->get()->toArray();
        
        // Initialize an empty array to store the data of all drivers
        $drivers = [];
        
        // Loop through each driver and format their data for the view
        foreach ($dbDrivers as $dbDriver) {
            $drivers[] = [
                'id' => $dbDriver['id_uzivatel'],
                'firstName' => $dbDriver['meno_uzivatela'],
                'lastName' => $dbDriver['priezvisko_uzivatela'],
                'email' => $dbDriver['email_uzivatela'],
            ];
        }
        return $drivers;
    }

    /* assignGetVehicles()
    DESCRIPTION:    - Function which gets all vehicles from the database and formats them
                    - Returns an array of vehicles
                    - Given data will be used for select input field
    */
    private function assignGetVehicles()
    {
        // Retrieve all vehicles from the database
        $dbVehicles = Vozidlo::all()->toArray();
        
        // Initialize an empty array to store the data of all vehicles
        $vehicles = [];
        
        // Loop through each vehicle and format the data
        foreach ($dbVehicles as $dbVehicle) {
            $vehicles[] = [
                'id' => $dbVehicle['id_vozidlo'],
                'spz' => $dbVehicle['spz'],
            ];
        }
        return $vehicles;
    }

    /* assignSave()
    DESCRIPTION:    - Function which validates and updates a assigned driver
                    - Refreshes the list component
    */
    public function assignSave($scheduleId) 
    {   
        //dd($this->scheduledDriver, $this->scheduledVehicle);
        // Check if the input fields aren't empty
        try { 
            $validatedData = $this->validate([
                'scheduledDriver' => 'required|integer',
                'scheduledVehicle' => 'required|integer',
            ], [
                'scheduledDriver.required'  => 'Vodič nie je vyplnený',
                'scheduledVehicle.required' => 'Vozidlo nie je vyplnené',
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

        // Update the schedule with the selected driver and vehicle
        PlanovanySpoj::where('id_plan_trasy', '=', $scheduleId)
                     ->update(['id_uzivatel_sofer' => $this->scheduledDriver, 'id_vozidlo' => $this->scheduledVehicle]);


        // toggleoff edit, dispatch event and display success message
        $this->editButton = false;
        $this->dispatch('assign-vehicles-list-edit')->to(AssignVehiclesListEdit::class);
        $this->dispatch('alert-success', message: "Vodič a vozidlo boli úspešne aktualizované");
    }

    /* assignEdit()
    DESCRIPTION:    - Function which toggles the edit option for a schedules (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function assignEdit($scheduleId)
    {
        if ($this->editButton && $this->editValue === $scheduleId) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->editButton = true;
            $this->editValue = $scheduleId;
            
            // Get data about the selected scheduled route from the database
            $selectedScheduledRoute = PlanovanySpoj::where('id_plan_trasy', '=', $scheduleId)->first();

            // Fill the input fields with the scheduled route data
            if (is_null($selectedScheduledRoute)) {
                $this->scheduledDriver= "N/A";
                $this->scheduledVehicle = "N/A";
            } else {
                $this->scheduledDriver= $selectedScheduledRoute->id_uzivatel_sofer;
                $this->scheduledVehicle = $selectedScheduledRoute->id_vozidlo;
            }
        }
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('assign-vehicles-list-edit')]
    public function mount() {

        // Get all scheduled routes from the database
        $this->scheduledRoutes = $this->assignGetScheduledRoutes();

        // Get all drivers & vehicles from the database (select input fields)
        $this->drivers = $this->assignGetDrivers();
        $this->vehicles = $this->assignGetVehicles();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.assign-vehicles-list-edit');
    }
}
