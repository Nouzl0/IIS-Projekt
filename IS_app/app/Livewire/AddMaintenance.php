<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Vozidlo;
use App\Models\Udrzba;

class AddMaintenance extends Component
{
    public $vehicles;
    public $maintenancedVehicle;
    public $curentDateTime;
    public $isEdit = false;
    public $id_vozidlo;
    public $spz, $created_at, $cas, $datum, $stav, $popis;

    public function mount() {
        $this->vehicles = Vozidlo::all();
    }

    public function render()
    {
        return view('livewire.add-maintenance');
    }


    public function submit() {
        $maintenancedVehicle = Vozidlo::where('spz', $this->spz)->first();
        $curentDateTime = now();
        $time = Carbon::parse($this->datum, "T", $this->cas, "+00:00"); // upravit cas, nefunguje

        // ToDO 
        //      id_udrzba
        //      cas
        Udrzba::create([
            'zaciatok_udrzby' => $time,
            'id_vozidlo' => $maintenancedVehicle->id_vozidlo,
            'spz' => $this->spz,
            'stav' => $this->stav,
            'popis' => $this->popis,
        ]);
        return redirect()->to('/recordMaintenance');   // refresh the page
        
    }

}
