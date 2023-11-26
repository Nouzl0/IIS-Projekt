<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Usek;
use App\Models\Trasa;
use Illuminate\Support\Facades\DB;

class HomeListTimetables extends Component
{
    /* ATRIBUTES */

    // The property that contains all timetables of the public transportation
    public $timetables = [];


    /* FUNCTIONS */
    
    /* formatTimetables()
    DESCRIPTION:    - Helper function to format timetables data
                    - Returns an array of formatted timetables
    */
    // Helper function to format timetables data
    private function formatTimetables($timetables)
    {
        $formattedTimetables = [];

        foreach ($timetables as $lineNumber => $stops) {
            $formattedTimetables[$lineNumber] = implode(', ', $stops);
        }

        return $formattedTimetables;
    }

    
    /* LIVEWIRE */

    /* mount()
    DESCRIPTION:    - Component constructor which builds the public transport timetable from the database
                    - Constructor of the component
    */
    public function mount()
    {
        // Get all stops from the database
        $zastavky = DB::table('zastavka')->pluck('meno_zastavky', 'id_zastavka')->toArray();

        // Get all routes with additional informaton about the line of the route
        $linky_trasy = Trasa::select(
            'trasa.*',
            'linka.cislo_linky'
        )
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->get()
        ->toArray();

        // First loop through the routes, to firstly fill only the cislo_linky into the timetables array
        foreach ($linky_trasy as $linka_trasa) {
            $this->timetables[$linka_trasa['cislo_linky']] = [];
        }

        // Variables of previous route and line for checks
        $predosla_id_trasa = null;
        $predosla_id_linka = null;

        // Second loop through the routes, to fill the stops of each line number
        foreach ($linky_trasy as $linka_trasa) {

            // If the id_trasa changed and the id_linka didn't, skip the current route because we don't want all the stops to be shown two times, but only once
            if (($predosla_id_trasa !== $linka_trasa['id_trasa']) && ($predosla_id_linka === $linka_trasa['id_linka']) && ($predosla_id_trasa !== null) && ($predosla_id_linka !== null)) {
                $predosla_id_trasa = $linka_trasa['id_trasa'];
                $predosla_id_linka = $linka_trasa['id_linka'];
                continue;
            }

            // Get all sections for the current route
            $useky_na_trase = Usek::where('id_trasa', '=', $linka_trasa['id_trasa'])->get()->toArray();

            $pocet_usekov_na_trase = count($useky_na_trase);        // count all the sections on the selected route
            $pocet_spracovanych_usekov = 0;                         // set a counter for the already handled sections

            // Loop through the sections of the current route and add all the stops for the current route
            foreach ($useky_na_trase as $usek_na_trase) {
                $pocet_spracovanych_usekov++;

                $this->timetables[$linka_trasa['cislo_linky']][] = $zastavky[$usek_na_trase['id_zastavka_zaciatok']];

                if ($pocet_spracovanych_usekov === $pocet_usekov_na_trase) {
                    $this->timetables[$linka_trasa['cislo_linky']][] = $zastavky[$usek_na_trase['id_zastavka_koniec']];
                }
            }

            // Set the helper variables for previous route
            $predosla_id_trasa = $linka_trasa['id_trasa'];
            $predosla_id_linka = $linka_trasa['id_linka'];
        }
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        // Format the timetables data before passing it to the view
        $formattedTimetables = $this->formatTimetables($this->timetables);

        return view('livewire.home-list-timetables', ['formattedTimetables' => $formattedTimetables]);
    }
}
