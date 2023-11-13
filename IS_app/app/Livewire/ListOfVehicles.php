<?php

namespace App\Livewire;

use Livewire\Component;

class ListOfVehicles extends Component
{
    public $isEdit = false;
    public function render()
    {
        return view('livewire.list-of-vehicles');
    }

    public function ToggleContentSwitch () {
        $this->isEdit = !$this->isEdit;
    }

    

}
