<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vozidlo;

class AddVehicles extends Component
{
    public $spz;
    public $nazov_vozidla;
    public $druh_vozidla;
    public $znacka_vozidla;

    public function render()
    {
        return view('livewire.add-vehicles');
    }
  

    public function submit() {
        $vehicle_exists = Vozidlo::where('spz', $this->spz)->first();   // check if the vehicle with the inputted SPZ already exists
        if ($vehicle_exists) {
            session()->now('message','Vozidlo so zadanou ŠPZ už existuje.'); // if it already exists in the DB, show the user a message
            return;
        }

        Vozidlo::create(['nazov' => $this->nazov_vozidla, 'spz' => $this->spz, 'druh_vozidla' => $this->druh_vozidla, 'znacka_vozidla' => $this->znacka_vozidla]); // insert into Vozidlo table
        session()->now('message','Vozidlo bolo úspešne pridané');   // show successful message to user
         
        return redirect()->to('/manageVehicles');   // refresh the page
    }
}
