<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

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
    
    TODO:           - Get all scheduledRoutes from the database which are NOT in the past
                    - Get additional information about the scheduled route
                    - Format the scheduledRoute data
    */
    private function assignGetScheduledRoutes()
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
                'vehicle' => "N/A",
            ];
        }
        return $scheduledRoutes;
    }
    
    /* assignGetDrivers()
    DESCRIPTION:    - Function which gets all driver (users) from the database and formats them
                    - Returns an array of drivers
                    - Given data will be used for select input field
    
    TODO:           - Get all drivers from the database
                    - Format the driver data
    */
    private function assignGetDrivers()
    {
        // Retrieve all maintenance records from the database
        $dbDrivers = [1]; // TODO - get all routes from the database
        
        // Initialize an empty array to store maintenance data
        $drivers = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbDrivers as $dbDriver) {

            // TODO - get additional information about the route -> linkName

            // TODO - format the maintenance data (replace the 'N/A' values)
            $drivers[] = [
                'id' => "N/A",
                'firstName' => "N/A",
                'lastName' => "N/A",
                'email' => "N/A",
            ];
        }
        return $drivers;
    }

    /* assignGetVehicles()
    DESCRIPTION:    - Function which gets all vehicles from the database and formats them
                    - Returns an array of vehicles
                    - Given data will be used for select input field
    
    TODO:           - Get all vehicles from the database
                    - Format the driver data
    */
    private function assignGetVehicles()
    {
        // Retrieve all maintenance records from the database
        $dbVehicles = [1]; // TODO - get all routes from the database
        
        // Initialize an empty array to store maintenance data
        $vehicles = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbVehicles as $dbVehicle) {

            // TODO - get additional information about the route -> linkName

            // TODO - format the maintenance data (replace the 'N/A' values)
            $vehicles[] = [
                'id' => "N/A",
                'spz' => "N/A",
            ];
        }
        return $vehicles;
    }

    /* assignSave()
    DESCRIPTION:    - Function which validates and updates a assigned driver
                    - Refreshes the list component
    
    TODO:           - Validate the input fields, if needed add other checks
                    - Update the schedule with the given id
    */
    public function assignSave($scheduleId) 
    {   
        // Check if the input fields aren't empty
        try { 
            // TODO - Validate input fields with custom error messages
            $validatedData = $this->validate([
                'scheduledDriver' => 'required|string',
                'scheduledVehicle' => 'required|string',
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

        // TODO - add other checks


        // TODO - Update the schedule with the given validated data


        // toggleoff edit, dispatch event and display success message
        $this->editButton = false;
        $this->dispatch('assign-vehicles-list-edit')->to(AssignVehiclesListEdit::class);
        $this->dispatch('alert-success', message: "Vodič a vozidlo boli úspešne aktualizované");
    }

    /* assignEdit()
    DESCRIPTION:    - Function which toggles the edit option for a schedules (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields

    TODO:           - Get data about the scheduled route from the database
                    - Fill the input fields with the data (replace the 'N/A' values)
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
            
            // TODO - Get data about the scheduled route from the database

            // TODO - Fill the input fields with the data (replace the 'N/A' values)
            $this->scheduledDriver= "N/A";
            $this->scheduledVehicle = "N/A";
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
