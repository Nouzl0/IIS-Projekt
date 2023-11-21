<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Linka;

class ManageLinksAddLine extends Component
{

    public $cislo_linky, $vozidla_linky;
    

    // * lineAdd()
    // DESCRIPTION:    - Function which validates and updates in the database
    //                 - Uses 'Input field' for getting input data
    // */
    public function lineAdd() {
        try {
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'vozidla_linky' => 'required',
                'cislo_linky' => 'required|integer||unique:linka,cislo_linky',
            ], [
                'cislo_linky.required' => 'čislo linky je povinné',
                'cislo_linky.unique' => 'toto číslo linky je v databáze',
                'cislo_linky.integer' => 'toto číslo linky musí byť číslo',
                'vozidla_linky.required' => 'vyber typ vozidla',
            ]);

        // Displaying error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
                return;
            }
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Validation error");
            return;
        }

        Linka::create([
            'cislo_linky' => $validatedData['cislo_linky'],    
            'vozidla_linky' => $validatedData['vozidla_linky'],
        ]);
        $this->dispatch('alert-success', message: "Linka bola úspešne pridaná");
        return redirect()->to('/manageLinks');   // refresh the page

    }

    public function mount() {
    }

    public function render()
    {
        return view('livewire.manage-links-add-line');
    }
}
