<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vozidlo;

class AddVehicles extends Component
{
    public $id_vozidlo;
    public $nazov;
    public $druh_vozidla;
    public $znacka_vozidla;

    public function render()
    {
        return view('livewire.add-vehicles');
    }
  

    public function submit() {
        $this->validate([
            'id_vozidlo' => 'required',
            'nazov' => 'required',
            'druh_vozidla' => 'required',
            'znacka_vozidla' => 'required'
        ]);
        // dd($this->nazov);
        // TO DO
        // id uz je obsadene
        $vehicle = new Vozidlo;
        $vehicle->id_vozidlo = $this->id_vozidlo;
        $vehicle->nazov = $this->nazov;
        $vehicle->druh_vozidla = $this->druh_vozidla;
        $vehicle->znacka_vozidla = $this->znacka_vozidla;
        $vehicle->save();
        $this->resetFilters();
         
    
        return redirect()->to('/manageVehicles');
    }

    public function resetFilters() {
        $this->reset(['nazov', 'druh_vozidla','znacka_vozidla']);
    }

}
