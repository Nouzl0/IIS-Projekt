<?php

namespace App\Livewire;

use Livewire\Component;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use App\Models\Vozidlo;
use Livewire\Attributes\On;

class ListOfVehicles extends Component
{
    public $isEdit = false;
    public $vehicles;
    public $editValue='';
    public $id_vozidlo, $nazov, $druh_vozidla, $znacka_vozidla;

    public function mount() {
        $this->vehicles = Vozidlo::all();
    }


    public function updateVehicle() {
        Vozidlo::where('id_vozidlo', $this->id_vozidlo)->update([
            'id_vozidlo' => $this->id_vozidlo,
            'nazov' => $this->nazov,
            'druh_vozidla' => $this->druh_vozidla,
            'znacka_vozidla' => $this->znacka_vozidla
        ]);
        $this->resetFilters();
        return redirect()->to('/manageVehicles');
        

    }
    
    public function editVehicle($id_vozidlo) {
        $vehicle = Vozidlo::find($id_vozidlo);
        if ($vehicle) {
            $this->id_vozidlo = $vehicle->id_vozidlo;
            $this->nazov = $vehicle->nazov;
            $this->druh_vozidla = $vehicle->druh_vozidla;
            
            $this->znacka_vozidla = $vehicle->znacka_vozidla;
            
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
