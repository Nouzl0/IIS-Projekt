<?php

namespace App\Livewire;

use Livewire\Component;

class AssignVehiclesContainer extends Component
{
    /* ATRIBUTES */

    /* Show button properties */
    public $showValue = "edit";

    /* FUNCTIONS */

    /* toggleShow()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - User can choose between different relevant components
    */
    public function toggleShow($toggleValue)
    {
        $this->showValue = $toggleValue;

        // refresh used component
        switch($this->showValue) {
            case "assign":
                $this->dispatch('assign-vehicles-list-assign')->to(AssignVehiclesListAssign::class);
                break;
            case "history":
                $this->dispatch('assign-vehicles-list-edit')->to(AssignVehiclesListEdit::class);
                break;
            case "default":
                $this->dispatch('assign-vehicles-list-history')->to(AssignVehiclesListHistory::class);
                break;
        }
    }

    
    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.assign-vehicles-container');
    }
}
