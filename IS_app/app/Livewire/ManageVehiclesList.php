<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vozidlo;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ManageVehiclesList extends Component
{
    /* ATRIBUTES */

    /* All data property */
    public $vehicles;

    /* Edit button properties */
    public $editButton = false;
    public $editValue='';

    /* Input field properties */
    public $vehicleId; 
    public $spz; 
    public $vehicleName;
    public $vehicleType; 
    public $vehicleBrand;


    /* FUNCTIONS */

    /* vehicleGetAll()
    DESCRIPTION:    - Function which gets all the vehicles from the database and formats them
                    - Returns an array of vehicles
    */
    private function vehicleGetAll()
    {
        // Retrieve all users from the DB
        $dbVehicles = DB::table('vozidlo')->get()->toArray();

        // Initialize an empty array to store users
        $vehicles = [];

        // Loop through each user and format the data
        foreach ($dbVehicles as $dbVehicle) {
            $vehicles[] = [
                'vehicleId' => $dbVehicle->id_vozidlo,
                'spz' => $dbVehicle->spz,
                'vehicleName' => $dbVehicle->nazov,
                'vehicleType' => $dbVehicle->druh_vozidla,
                'vehicleBrand' => $dbVehicle->znacka_vozidla,
            ];
        }

        return $vehicles;
    }
    
    /* vehicleSave()
    DESCRIPTION:    - Function which validates and updates a vehicle in the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManageVehiclesList' to refresh the user's list
    */
    public function vehicleSave($spz) {
        try {
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'spz' => 'required|string|unique:vozidlo,spz,' . $spz . ',spz',
                'vehicleName' => 'required|string',
                'vehicleType' => 'required|string',
                'vehicleBrand' => 'required|string',
            ], [
                'spz.required' => 'ŠPZ nie je vyplnená',
                'spz.unique' => 'Vozidlo so zadanou ŠPZ už existuje',
                'vehicleName.required' => 'Meno vozidla nie je vyplnené',
                'vehicleType.required' => 'Druh vozidla nie je vyplnený',
                'vehicleBrand.required' => 'Značka vozidla nie je vyplnená',
            ]);

            // After successful validation, find the user with the given spz and update it's data
            Vozidlo::where('spz', $spz)->update([
                'spz' => $validatedData['spz'],
                'nazov' => $validatedData['vehicleName'],
                'druh_vozidla' => $validatedData['vehicleType'],
                'znacka_vozidla' => $validatedData['vehicleBrand'],
            ]);
    
            // toggleoff edit, dispatch event and display success message
            $this->editButton = false;
            $this->dispatch('refresh-vehicles-list')->to(ManageVehiclesList::class);
            $this->dispatch('alert-success', message: "Vozidlo \"$spz\", bolo úspešne aktualizované");
            return;
        
        // Displaying error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
            return;

        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Interná chyba, kontaktujte administrátora o chybe");
            return;
        }
    }

    /* vehicleEdit()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function vehicleEdit($spz)
    {
        if ($this->editButton && $this->editValue === $spz) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->editButton = true;
            $this->editValue = $spz;
            
            // Fill the input fields with the current user data
            $vehicle = DB::table('vozidlo')->where('spz', '=', $spz)->first();
            $this->vehicleId = $vehicle->id_vozidlo;
            $this->spz = $vehicle->spz;
            $this->vehicleName = $vehicle->nazov;
            $this->vehicleType = $vehicle->druh_vozidla;
            $this->vehicleBrand = $vehicle->znacka_vozidla;
        }
    }
    
    /* vehicleDelete()
    DESCRIPTION:    - Deletes a vehicle from the database
                    - Dispatches an event to component 'ManageVehicleList' to refresh the user's list
    */
    public function vehicleDelete($spz) {
        
        // delete user from DB
        DB::table('vozidlo')->where('spz', '=', $spz)->delete();

        // send a message & refresh list
        $this->dispatch('refresh-vehicles-list')->to(ManageVehiclesList::class);
        $this->dispatch('alert-success', message: "Vozidlo \"$spz\", bolo odstránené z databázy");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-vehicles-list')]
    public function mount() {

        // Get all vehicles from the database
        $this->vehicles = $this->vehicleGetAll();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
         /* - Used for rendering the component in the browser */
        return view('livewire.manage-vehicles-list');
    }
}
