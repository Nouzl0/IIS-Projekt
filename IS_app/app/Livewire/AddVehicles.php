<?php

namespace App\Livewire;

use Livewire\Component;

class AddVehicles extends Component
{
    public function render()
    {
        return view('livewire.add-vehicles');
    }
    public function editVehicles()
    {
        // backend code will be implemented later, right now rederict
        return redirect()->route('editVehicles');
    }

}
