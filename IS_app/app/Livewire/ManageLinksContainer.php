<?php

namespace App\Livewire;

use Livewire\Component;

class ManageLinksContainer extends Component
{
    /* ATRIBUTES */

    /* Show button properties */
    public $showValue = "Trasa";

    /* FUNCTIONS */

    /* maintenanceShow()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function toggleShow($toggleValue)
    {
        $this->showValue = $toggleValue;

        // refresh used component (TODO: fix this)
        //switch($this->showValue) {
        //    case "Requests":
        //        $this->dispatch('refresh-maintenances-list-requests')->to(Name::class);
        //        break;
        //    case "History":
        //        $this->dispatch('refresh-maintenances-list-history')->to(Name::class);
        //        break;
        //    case "default":
        //        $this->dispatch('refresh-maintenances-list-active')->to(Name::class);
        //        break;
        //}
    }

    
    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.manage-links-container');
    }
}
