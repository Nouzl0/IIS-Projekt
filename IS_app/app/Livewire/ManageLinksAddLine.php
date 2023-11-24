<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Linka;
use Livewire\Attributes\On;

class ManageLinksAddLine extends Component
{
    public $cislo_linky;
    public $vozidla_linky;
    

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
                'cislo_linky.required' => 'Čislo linky musí byť vyplnené',
                'cislo_linky.unique' => 'Existuje už linka s týmto číslom',
                'cislo_linky.integer' => 'Zadajte (číslo) linky',
                'vozidla_linky.required' => 'Typ vozidla musí byť vyplnený',
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

        $this->reset(['cislo_linky', 'vozidla_linky']);
        $this->dispatch('alert-success', message: "Linka bola úspešne pridaná");
        $this->dispatch('refresh-line-list')->to(ManageLinksLinesList::class);

    }

    /* LIVEWIRE */

    // * render()
    public function render()
    {
        return view('livewire.manage-links-add-line');
    }
}
