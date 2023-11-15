<?php

namespace App\Livewire;

use App\Models\Vozidlo;
use App\Models\Udrzba;
use Livewire\Component;

class ReportVehicleIssue extends Component
{
    public $spz;
    public $popis;

    public function render()
    {
        return view('livewire.report-vehicle-issue');
    }

    public function addVehicleIssueReport()
    {
        // Find the vehicle
        $vozidlo = Vozidlo::where('spz', $this->spz)->first();
        
        // If the vehicle is not found show message
        if (is_null($vozidlo)) {
            session()->now('message','Vozidlo so zadanou ŠPZ neexistuje.');
            return;
        }

        // Insert row into the Udrzba table and show successful ňmessage
        Udrzba::create(['id_vozidlo' => $vozidlo->id_vozidlo, 'spz' => $vozidlo->spz, 'stav' => 'Vytvorená', 'popis' => $this->popis]);
        session()->flash('message',"Závada na vozidle s ŠPZ: $vozidlo->spz bola nahlásená.");
    
        return redirect()->to('/reportIssue');   // refresh the page
    }
}
