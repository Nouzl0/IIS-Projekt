<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\PlanovanySpoj;
use App\Models\Uzivatel;
use App\Models\Vozidlo;

class AssignVehiclesListAssign extends Component
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
    public $scheduledDriver = [];
    public $scheduledVehicle = [];


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
        ->where('planovany_spoj.id_uzivatel_sofer', '=', null)
        ->where('planovany_spoj.id_vozidlo', '=', null)
        ->get()
        ->toArray();
        
        // Initialize an empty array to store maintenance data
        $scheduledRoutes = [];
        
        // Loop through each maintenance record and format the data
        foreach ($dbScheduledRoutes as $dbScheduledRoute) {

            // Format the scheduled routes data for the view
            $scheduledRoutes[] = [
                'id' => $dbScheduledRoute['id_plan_trasy'],
                'link' => $dbScheduledRoute['cislo_linky'],
                'name' => $dbScheduledRoute['meno_trasy'],
                'start' => $dbScheduledRoute['zaciatok_trasy'],
                'repeat' => $dbScheduledRoute['opakovanie'],
                'validUntil' => $dbScheduledRoute['platny_do'],
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
        $dbDrivers = Uzivatel::whereIn('rola_uzivatela', ['vodič', 'administrátor'])
            ->get(['id_uzivatel', 'meno_uzivatela', 'priezvisko_uzivatela', 'email_uzivatela'])
            ->toArray();

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
        // Check if the input fields aren't empty
        try { 
            $validatedData = $this->validate([
                "scheduledDriver.{$scheduleId}" => 'required|string',
                "scheduledVehicle.{$scheduleId}" => 'required|string',
            ], [
                "scheduledDriver.{$scheduleId}.required"  => 'Vodič nie je vyplnený',
                "scheduledVehicle.{$scheduleId}.required" => 'Vozidlo nie je vyplnené',
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
            $this->dispatch('alert-error', message: "ERROR - Interná chyba, kontaktujte administrátora o chybe");
            return;
        }

        // Get the driverId and vehicleId from the validated data
        $driverId = $validatedData['scheduledDriver'][$scheduleId];
        $vehicleId = $validatedData['scheduledVehicle'][$scheduleId];

        // if the vehicle is in maintenance, display error message
        // get planovanyspoj from the database and all meintenances for the vehicle
        $scheduledRoute = PlanovanySpoj::where('id_plan_trasy', '=', $scheduleId)->first();
        $maintenances = DB::table('udrzba')->where('id_vozidlo', '=', $vehicleId)->where('stav', '=', 'Priradená')->get();

        // Check if the planovanySpoj->zaciatok_trasy is before the maintenance->zaciatok_udrzby print error
        foreach ($maintenances as $maintenance) {
            if ($scheduledRoute->platny_do > $maintenance->zaciatok_udrzby) {
                $this->dispatch('alert-error', message: "Zadané vozidlo je v údržbe do " . $maintenance->zaciatok_udrzby . ", nie je možné ho priradiť");
                return;
            }
        }

        // Update the schedule with the selected driver and vehicle
        PlanovanySpoj::where('id_plan_trasy', '=', $scheduleId)
                     ->update(['id_uzivatel_sofer' => $driverId, 'id_vozidlo' => $vehicleId]);


        // toggleoff edit, dispatch event and display success message
        $this->editButton = false;
        $this->dispatch('assign-vehicles-list-assign')->to(AssignVehiclesListAssign::class);
        $this->dispatch('alert-success', message: "Vodič a vozidlo boli úspešne aktualizovaný");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('assign-vehicles-list-assign')]
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
        return view('livewire.assign-vehicles-list-assign');
    }
}
