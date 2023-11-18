<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Usek;
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
    DESCRIPTION:    - Component constructor which build the public transport timetable from the database
                    - Constructor of the component

    TODO:           - Check if error handling is needed add it or remove my code snippet
    */
    public function mount()
    {
        // Retrieve all stops(zastavky) from the DB
        $stops = DB::table('zastavka')->pluck('meno_zastavky', 'id_zastavka')->toArray();

        // Retrieve all necessary information about lines(linky), routes(trasy) and sections(useky)
        $results = Usek::select(
            'usek.*',
            'trasa.meno_trasy',
            'linka.cislo_linky',
            'linka.vozidla_linky',
        )
        ->join('trasa', 'usek.id_trasa', '=', 'trasa.id_trasa')
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->get()
        ->toArray();
        
        // First loop through the query results, to firstly fill only the cislo_linky into the timetables array
        foreach ($results as $result) {
            if (in_array($result['cislo_linky'], $this->timetables) === false) {        // if the cislo_linky is not in the array
                $this->timetables[$result['cislo_linky']] = [];                         // append it to the timetables array
            }
        }

        // Second loop through the query results, to fill the zastavky(stops) array of each cislo_linky(line_number)
        foreach ($results as $result) {
            if ( (($result['id_trasa'] % 2 != 0) && (array_key_exists($result['id_zastavka_zaciatok'], $stops))) || (($result['id_trasa'] % 2 == 0) && ($result['poradie_useku'] == 1)) ) {     // if the id_trasa is an odd number and the zastavka(stop) exists in DB or the id_trasa is an even number and the poradie_useku is one (complete loop of the route) 
                $this->timetables[$result['cislo_linky']][] = $stops[$result['id_zastavka_zaciatok']];                  // append the name of the zastavka(stop) to the array of the appropriate cislo_linky(line_number)
            }
        }

        // TODO - Error handling
        //'$this->dispatch('alert-error', message: $errorMessage);'
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        // Format the timetables data before passing it to the view
        $formattedTimetables = $this->formatTimetables($this->timetables);

        return view('livewire.home-list-timetables', ['formattedTimetables' => $formattedTimetables]);
    }
}
