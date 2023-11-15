<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vozidlo;
use App\Models\Udrzba;


class ListOfMaintenance extends Component
{
    public $maintenance;
    public $vehicles;
    public $isEdit = false;
    public $editValue='';
    public $id_vozidlo;
    public $id_udrzba, $spz, $created_at, $cas, $datum, $stav, $popis;



    public function mount() {
        $this->maintenance = Udrzba::all();
        $this->vehicles = Vozidlo::all();
    }

    public function updateMaintenance() {
        Udrzba::where('id_udrzba', $this->id_udrzba)->update([
            'zaciatok_udrzby' => $this->datum,
            'id_vozidlo' =>  $this->id_vozidlo,
            'spz' =>  $this->spz,
            'stav' =>  $this->stav,
            'popis' =>  $this->popis,
        ]);
        $this->resetFilters();
        $this->mount(); // refresh
    }

    public function editMaintenance($id_udrzba) {

        $maintenance = Udrzba::find($id_udrzba);
        if ($maintenance) {
            $this->id_udrzba = $maintenance->id_udrzba;
            $this->datum = $maintenance->zaciatok_udrzby;
            $this->id_vozidlo = $maintenance->id_vozidlo;
            $this->spz = $maintenance->spz;
            $this->stav = $maintenance->stav;
            $this->popis = $maintenance->popis;
        }
    }

    public function deleteMaintenance($id) {
        Udrzba::find($id)->delete();
        $this->mount(); // refresh view
    }

    public function render()
    {
        return view('livewire.list-of-maintenance');
    }

    public function toggleEdit($id)
    {
        if ($this->isEdit && $this->editValue === $id) {
            // If the button is already in edit mode for the current user, turn it off

            $this->updateMaintenance(); 
            
            $this->isEdit = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            
            $this->editMaintenance($id);

            $this->isEdit = true;
            $this->editValue = $id;
        }
        // dd($this->isEdit, $this->editValue);
    }

    public function resetFilters() {
        $this->reset(['id_vozidlo','spz', 'stav', 'popis', 'created_at']);
    }
}
