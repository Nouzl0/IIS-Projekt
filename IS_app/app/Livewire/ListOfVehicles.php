<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vozidlo;

class ListOfVehicles extends Component
{
    public $isEdit = false;
    public $vehicles;
    public $editValue='';
    public $id_vozidlo, $nazov, $spz, $druh_vozidla, $znacka_vozidla;

    public function mount() {
        $this->vehicles = Vozidlo::all();
    }


    public function updateVehicle() {
        // Check if the vehicle with the inputted SPZ already exists
        $spz_already_exists = Vozidlo::where('spz', $this->spz)->first();

        if ( $spz_already_exists ) {
            // Update the attributes of the vehicle(Vozidlo) without the spz attribute because we cannot have two of the same spz
            Vozidlo::where('id_vozidlo', $this->id_vozidlo)->update([
                'nazov' => $this->nazov,
                'druh_vozidla' => $this->druh_vozidla,
                'znacka_vozidla' => $this->znacka_vozidla
            ]);
            //session()->flash('message','Vozidlo so zadanou ŠPZ už existuje, ŠPZ sa teda neaktualizovala.'); // if it already exists in the DB, show the user a message
        } else {
            // Update the attributes of the vehicle(Vozidlo)
            Vozidlo::where('id_vozidlo', $this->id_vozidlo)->update([
                'spz' => $this->spz,
                'nazov' => $this->nazov,
                'druh_vozidla' => $this->druh_vozidla,
                'znacka_vozidla' => $this->znacka_vozidla
            ]);
        }
        $this->resetFilters();
        return redirect()->to('/manageVehicles');
    }
    
    public function editVehicle($id_vozidlo) {
        $vehicle = Vozidlo::find($id_vozidlo);
        if ($vehicle) {
            $this->id_vozidlo = $vehicle->id_vozidlo;
            $this->spz = $vehicle->spz;
            $this->nazov = $vehicle->nazov;
            $this->druh_vozidla = $vehicle->druh_vozidla;
            
            $this->znacka_vozidla = is_null($vehicle->znacka_vozidla) ? '' : $vehicle->znacka_vozidla;
            
        }
    }

    public function render()
    {
        return view('livewire.list-of-vehicles');
    }

    public function ToggleContentSwitch () {
        $this->isEdit = !$this->isEdit;
    }

    public function deleteVehicle($id) {
        Vozidlo::find($id)->delete();
        $this->mount(); // refresh view
    }
    
    public function toggleEdit($id)
    {
        if ($this->isEdit && $this->editValue === $id) {
            // If the button is already in edit mode for the current user, turn it off

            $this->updateVehicle(); 
            
            $this->isEdit = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            
            $this->editVehicle($id);

            $this->isEdit = true;
            $this->editValue = $id;
        }
        // dd($this->isEdit, $this->editValue);
    }

    public function resetFilters() {
        $this->reset(['nazov', 'druh_vozidla','znacka_vozidla']);
    }
}
