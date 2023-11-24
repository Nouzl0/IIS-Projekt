<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Zastavka;


class ManageLinksAddStop extends Component
{
    /* Input field properties */
    public $stop_name;      
    public $stop_address;


    /* FUNCTIONS */

    /* stopAdd()
    DESCRIPTION:    - Function which validates and adds a new stop to the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 
    */
    public function stopAdd()
    {
        try { 

            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'stop_name' => 'required|string|unique:zastavka,meno_zastavky',
                'stop_address' => 'required|string',
            ], [
                'stop_name.required' => 'Vyplnte meno zastávky',
                'stop_address.required' => 'Vyplnte adresu',
                'stop_name.unique' => 'Zástavka už existuje',
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
            $this->dispatch('alert-error', message: "ERROR - Validation failed");
            return;
        }

        // After successful validation, create a new stop in the database
        Zastavka::create([
            'meno_zastavky' => $validatedData['stop_name'],
            'adresa_zastavky' => $validatedData['stop_address'],
        ]);


        // Reset input field properties, display success message and dispatch an event to refresh the users list
        $this->reset(['stop_name', 'stop_address']);
        $this->dispatch('refresh-stop-list')->to(ManageLinksListOfStops::class);
        $this->dispatch('alert-success', message: "Zastávka bol pridaná do databázy");

    }


    public function render()
    {
        return view('livewire.manage-links-add-stop');
    }
}
