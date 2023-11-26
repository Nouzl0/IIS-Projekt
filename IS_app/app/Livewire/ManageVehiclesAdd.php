<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vozidlo;

class ManageVehiclesAdd extends Component
{
    /* ATRIBUTES */

    /* Input field properties */
    public $spz;
    public $vehicleName;
    public $vehicleType;
    public $vehicleBrand;


    /* FUNCTIONS */

    /* searchAdd()
    DESCRIPTION:    - Function which validates and adds a new vehicle to the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManageUsersList' to refresh the user's list
    */
    public function vehicleAdd()
    {
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'spz' => 'required|string|unique:vozidlo,spz',
                'vehicleName' => 'required|string',
                'vehicleType' => 'required|string',
                'vehicleBrand' => 'required|string',
            ], [
                'spz.required' => 'ŠPZ nie je vyplnená',
                'spz.unique' => 'Vozidlo s touto SPZ už existuje',
                'vehicleName.required' => 'Meno vozidla nie je vyplnené',
                'vehicleType.required' => 'Typ vozidla nie je vyplnený',
                'vehicleBrand.required' => 'Značka vozidla nie je vyplnená',
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
            
        // After successful validation, create a new vehicle with the validated data
        Vozidlo::create([
            'spz' => $validatedData['spz'],
            'nazov' => $validatedData['vehicleName'],
            'druh_vozidla' => $validatedData['vehicleType'],
            'znacka_vozidla' => $validatedData['vehicleBrand'],
        ]);


        // Reset input field properties, display success message and dispatch an event to refresh the users list
        $spz = $validatedData['spz'];
        $this->reset(['spz', 'vehicleName', 'vehicleType', 'vehicleBrand']);
        $this->dispatch('refresh-vehicles-list')->to(ManageVehiclesList::class);
        $this->dispatch('alert-success', message: "Vozidlo \"$spz\", bolo pridané do databázy");
    }


    /* LIVEWIRE */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.manage-vehicles-add');
    }
}
