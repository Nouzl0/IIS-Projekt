<?php

namespace App\Livewire;

use App\Models\Zastavka;
use App\Models\Usek;
use Livewire\Component;
use DateTime;

class HomeAddSearch extends Component
{
    /* ATRIBUTES */

    /* Input field properties */
    public $busStop;      
    public $date;
    public $time;


    /* FUNCTIONS */

    /* searchAdd()
    DESCRIPTION:    - Function which searches for routes with given input data and then
                      redirects to the search page with the results
                    - Uses 'Input field' for getting input data
    */
    public function searchAdd()
    {
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'busStop' => 'required',
                'date' => 'required',
                'time' => 'required',
            ], [
                'busStop.required' => 'Zadajte zastávku',
                'date.required' => 'Zadajte dátum',
                'time.required' => 'Zadajte čas',
            ]);

        // If validation fails, exception is caught and then is displayed error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
            return;

        // If there is any other exception, display basic error message
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Validation failed");
            return;
        }
            
    
        /****** SEARCH THE DB AND CREATE RESULTS ******/
        // Selected stop from DB
        $vybrata_zastavka = Zastavka::where('meno_zastavky', '=', $this->busStop)->first();

        // Check if the selected stop exists
        if (is_null($vybrata_zastavka)) {
            $this->dispatch('alert-error', message: "Zadaná zastávka neexistuje");
            return;
        }

        // Planned routes that go through the selected stop
        $spoje_cez_zastavku = Usek::select(
            'usek.*',
            'trasa.id_trasa',
            'trasa.meno_trasy',
            'linka.cislo_linky',
            'linka.vozidla_linky',
            'planovany_spoj.id_plan_trasy',
            'planovany_spoj.zaciatok_trasy',
            'planovany_spoj.opakovanie',
            'planovany_spoj.platny_do'
        )
        ->join('trasa', 'usek.id_trasa', '=', 'trasa.id_trasa')
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->join('planovany_spoj', 'trasa.id_trasa', '=', 'planovany_spoj.id_trasa')
        ->where('id_zastavka_zaciatok', '=', $vybrata_zastavka->id_zastavka)
        ->get()
        ->toArray();

        // Array for the formatted data that will be provided to the view
        $departures = [];

        // Cycle through the planned routes that go through the selected stop and add the desired data to the departures array
        foreach ($spoje_cez_zastavku as $spoj_cez_zastavku) {

            // Arrays for both date and time
            $zaciatok_trasy_datum_cas = explode(' ', $spoj_cez_zastavku['zaciatok_trasy']);     // separate the date and time from the zaciatok_trasy
            $trasa_platna_do_datum_cas = explode(' ', $spoj_cez_zastavku['platny_do']);         // separate the date and time from the platny_do
            
            // Variables for just dates
            $zaciatok_trasy_datum = new DateTime($zaciatok_trasy_datum_cas[0]);     // just the date of the start of the route
            $trasa_platna_do_datum = new DateTime($trasa_platna_do_datum_cas[0]);   // just the date that shows until when the route is valid
            $vybraty_datum = new DateTime($this->date);                             // selected date by the user
            //dd($vybraty_datum, $zaciatok_trasy_datum, $trasa_platna_do_datum);

            // Variables for just time
            $zaciatok_trasy_cas = new DateTime($zaciatok_trasy_datum_cas[1]);
            $trasa_platna_do_cas = new DateTime($trasa_platna_do_datum_cas[1]);
            $vybraty_cas = new DateTime($this->time);
            //dd($vybraty_cas, $zaciatok_trasy_cas, $trasa_platna_do_cas);
            
            if (($zaciatok_trasy_datum <= $vybraty_datum) && ($vybraty_datum <= $trasa_platna_do_datum)) {      // if the selected date is valid for the current planned route, show the planned route to the user
                //dd($vybraty_datum, $zaciatok_trasy_datum, $trasa_platna_do_datum);

                $useky_na_trase = Usek::where('id_trasa', '=', $spoj_cez_zastavku['id_trasa'])->get()->toArray();   // retrieve all sections of that route

                $suma_minut = 0;   // variable for the duration of the journey from the beginning to the selected stop

                // Cycle through all the sections of the route that goe through the selected stop
                foreach ($useky_na_trase as $usek_na_trase) {
                    if ($usek_na_trase['id_zastavka_zaciatok'] == $vybrata_zastavka['id_zastavka']) {       // if the starting stop of the section equals selected stop, then stop the calculation of the duration
                        break;
                    } 
                    $suma_minut += $usek_na_trase['cas_useku_minuty'];     // add the duration of the section to the entire duration of the journey
                }

                // Calculate the duration of the journey until the selected stop
                $cas_prichodu_na_vybratu_zastavku = $zaciatok_trasy_cas;
                $cas_prichodu_na_vybratu_zastavku->modify("+$suma_minut minutes");

                // If the selected time is earlier than the time of arrival to the selected stop -> show the planned route to the user, otherwise continue with another planned route
                if ($vybraty_cas <= $cas_prichodu_na_vybratu_zastavku) {
                    $departures[] = ['line' => $spoj_cez_zastavku['cislo_linky'], 'id_route' => $spoj_cez_zastavku['id_trasa'], 'id_planned_route' => $spoj_cez_zastavku['id_plan_trasy'], 'route' => $spoj_cez_zastavku['meno_trasy'], 'time' => $cas_prichodu_na_vybratu_zastavku->format('H:i:s'), 'date' => $vybraty_datum->format('d.m.Y')]; // store the data for the view
                } else {
                    continue;
                }
            } else {        // if the selected date is invalid for the current planned route, don't show this planned route to the user and continue with another palnned route
                continue;
            }
        }
        /****** END SEARCH THE DB AND CREATE RESULTS ******/

        // Store the selected bus stop for the search view
        session(['selectedBusStop' => $this->busStop]);

        // Rederict's to the search page with the searched results        
        $this->reset(['busStop', 'date', 'time']);
        session(['departuresResults' => $departures]);
        return redirect()->route('search');
    }


    /* LIVEWIRE */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.home-add-search');
    }
}
