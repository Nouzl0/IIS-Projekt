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

    /* userAdd()
    DESCRIPTION:    - Function which validates and adds a new user to the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 

    NOTES:          - This function is completed and should be used as template for creating other similiar components
                    - After finishing the project [notes, todo] should be removed
    
    TODO:           - Test the component in the browser
    */
    public function stopAdd()
    {
        try { 

            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'stop_name' => 'required|string',
                'stop_address' => 'required|string',
            ], [
                'stop_name.required' => 'Vyplnte meno zastávky',
                'stop_address.required' => 'Vyplnte adresu',
                'stop_name.unique' => 'Zastávak už existuje',
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
        

        // $stop_exists = Zastavka::where ('meno_zastavky', $this->stop_name)->first();
        // if ($stop_exists) {
        //     // error msg
        //     $this->dispatch('alert-error', message: "Zástávka už existuje\n");
        //     return;
        // }

        Zastavka::create([
            'meno_zastavky' => $validatedData['stop_name'],
            'adresa_zastavky' => $validatedData['stop_address'],
        ]);
        return redirect()->to('/manageLinks');   // refresh the page

        // Reset input field properties, display success message and dispatch an event to refresh the users list
        $this->reset(['stop_name', 'stop_address']);
        $this->dispatch('refresh-stop-list')->to(ManageLinksAddStop::class);
        $this->dispatch('alert-success', message: "Zastávka bol pridaná do databázy");
        // return redirect()->to('/manageLinks');   // refresh the page


    }


    public function render()
    {
        return view('livewire.manage-links-add-stop');
    }
}
