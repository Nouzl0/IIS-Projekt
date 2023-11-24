<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Linka;
use Livewire\Attributes\On;


class ManageLinksLinesList extends Component
{
    public $lines; // all lines

    public $editButton = false;
    public $editValue = '';

    /* Input field properties */
    public $cislo_linky;
    public $vozidla_linky;


    /* FUNCTIONS */

    /* lineGetAll()
    DESCRIPTION:    - Function which gets all the lines from the database and formats them
                    - Returns an array of lines
    */
    private function lineGetAll()
    {
        // Retrieve all lines from the DB
        $dblines = DB::table('linka')->get()->toArray();

        // Initialize an empty array to store lines
        $lines = [];

        // Loop through each user and format the data
        foreach ($dblines as $dbLine) {
            $lines[] = [
                'cislo_linky' => $dbLine->cislo_linky,
                'vozidla_linky' => $dbLine->vozidla_linky,
            ];
        }

        return $lines;
    }

    /* linesave()
    DESCRIPTION:    - Function which validates and updates a user in the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManagelinesList' to refresh the user's list
    */
    public function lineSave($id) {
        try {
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'vozidla_linky' => 'required',
                'cislo_linky' => 'required|integer|unique:linka,cislo_linky,' . $id . ',cislo_linky',
            ], [
                'cislo_linky.required' => 'Čislo linky musí byť vyplnené',
                'cislo_linky.unique' => 'Existuje už linka s týmto číslom',
                'cislo_linky.integer' => 'Zadajte (číslo) linky',
                'vozidla_linky.required' => 'Typ vozidla musí byť vyplnený',
            ]);

            // After successful validation, find the user with the given email and update it's data
            Linka::where('cislo_linky', $id)->update([
                'cislo_linky' => $validatedData['cislo_linky'],
                'vozidla_linky' => $validatedData['vozidla_linky'],
            ]);
    
            // toggleoff edit, dispatch event amd display success message
            $this->editButton = false;
            $this->dispatch('refresh-line-list')->to(ManageLinksLinesList::class);
            $this->dispatch('alert-success', message: "Linka bola úspešne aktualizovaná");
            return;
        
        // Displaying error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Validation error");
        }
    }

    /* userEdit()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function lineEdit($cislo_linky)
    {
        if ($this->editButton && $this->editValue == $cislo_linky) {

            // If the button is already in edit mode for the current line, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different line, turn it on
            $this->editButton = true;
            $this->editValue = $cislo_linky;
            
            // Fill the input fields with the current line data
            $new_line = DB::table('linka')->where('cislo_linky', '=', $cislo_linky)->first();
            $this->cislo_linky = $new_line->cislo_linky;
            $this->vozidla_linky = $new_line->vozidla_linky;
        }
    }

    /* lineDelete()
    DESCRIPTION:    - add descriptio TODO
    */
    public function lineDelete($cislo_linky) {
        
        // delete user from DB
        try{
            DB::table('linka')->where('cislo_linky', '=', $cislo_linky)->delete();
    
            // send a message & refresh list
            $this->dispatch('refresh-line-list')->to(ManageLinksLinesList::class);
            $this->dispatch('alert-success', message: "Linka bola odstránená z databázy");
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "Ku linke sú priradené trasy, nie je možné ju odstrániť");
        }
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-line-list')]
    public function mount()
    {
        // Set the $lines property with the formatted lines array
        $this->lines = $this->lineGetAll();
    }

    public function render()
    {
        return view('livewire.manage-links-lines-list');
    }
}
