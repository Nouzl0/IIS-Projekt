<?php

namespace App\Livewire;

use App\Models\Zastavka;
use App\Models\Usek;
use Livewire\Component;

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

    TODO:           - Finish the function, (searching routes) & (redirecting to the search page with the results)
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
            
        /* TODO - After successful validation, search and create results of the search
                which will be displayed on search page, code bellow is just for testing
        */
        /* $departures = [
            0 => ['line' => '52', 'route' => 'Královo Pole, nádraží', 'time' => '15:53', 'date' => '18.11.2023'],
            1 => ['line' => '48', 'route' => 'Královo Pole, nádraží', 'time' => '16:53', 'date' => '18.11.2023'],
            2 => ['line' => '52', 'route' => 'Královo Pole, nádraží', 'time' => '17:53', 'date' => '18.11.2023'],
        ]; */

        // Selected stop from DB
        $vybrata_zastavka = Zastavka::where('meno_zastavky', '=', $this->busStop)->first();

        // Planned routes that go through the selected stop
        $spoje_cez_zastavku = Usek::select(
            'usek.*',
            'trasa.meno_trasy',
            'linka.cislo_linky',
            'linka.vozidla_linky',
            'planovany_spoj.zaciatok_trasy',
            'planovany_spoj.opakovanie',
            'planovany_spoj.platny_do'
        )
        ->join('trasa', 'usek.id_trasa', '=', 'trasa.id_trasa')
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->join('planovany_spoj', 'trasa.id_trasa', '=', 'planovany_spoj.id_trasa')
        ->where('id_zastavka_zaciatok', '=', $vybrata_zastavka->id_zastavka)
        ->orWhere('id_zastavka_koniec', '=', $vybrata_zastavka->id_zastavka)
        ->get()
        ->toArray();

        $departures = [];

        // Cycle through the planned routes that go through the selected stop and add the desired data to the departures array
        foreach ($spoje_cez_zastavku as $spoj_cez_zastavku) {
            $useky_na_trase = Usek::where('id_trasa', '=', $spoj_cez_zastavku['id_trasa'])->get()->toArray();   // retrieve all sections of that route

            $sum = 0;   // variable for the duration of the journey from the beginning to the selected stop

            // Cycle through all the sections of the route that goes through the selected stop
            foreach ($useky_na_trase as $usek_na_trase) {
                if ($usek_na_trase['id_zastavka_zaciatok'] == $vybrata_zastavka['id_zastavka']) {       // if the starting stop of the section equals selected stop, then stop the calculation of the duration
                    break;
                } 
                $sum += $usek_na_trase['cas_useku_minuty'];     // add the duration of the section to the entire duration of the journey
            }

            dd($spoj_cez_zastavku['cislo_linky'], $spoj_cez_zastavku['meno_trasy'], $sum); // These values should be added to the departures array
            // TODO  - create the departures array with cislo_linky, meno_trasy, cas_prichodu_do_zvolenej_zastavky
            // TODO  - calculate the exact time for the selected stop (something like $spoj_cez_zastavku['zaciatok_trasy'] + $sum, but the 'zaciatok_trasy is DateTime')
            // TODO  - filter the planned routes according to the inputted date and time
        }

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
