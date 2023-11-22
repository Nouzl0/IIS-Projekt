<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use App\Models\Usek;
use DateTime;


class SearchListDepartures extends Component
{
    /* ATRIBUTES */

    /* Data propertie */
    public $departures = [];          // Given by another component
    public $routes = [];              // Created by departureShow() function
    
    /* Show button properties */
    public $showButton = false;
    public $showValueTime = '';
    public $showValueDate = '';
    public $showValueRoute = '';


    /* FUNCTIONS */

    /* userShow()
    DESCRIPTION:    - Function which toggles the show option for a user (UI)
                    - Uses 'Show button' properties for displaying the UI
                    - Upadates route depening on which route is selected
    
    TODO:           - Finish the function, (updating route) & (displaying the route data)
    */
    public function departureShow($departure)
    {
        $this->routes = [];
        $departure = json_decode($departure, true);
        //dd($departure);

        if ($this->showButton && ($this->showValueTime === $departure['time']) && ($this->showValueDate === $departure['date']) && ($this->showValueRoute === $departure['route'])) {
            // If the button is already in show mode for the current search, turn it off
            $this->showButton = false;
            $this->showValueTime = '';
            $this->showValueDate = '';
            $this->showValueRoute = '';
        } else {
            // If the button is not in show mode or is in show mode for a different serach, turn it on
            $this->showButton = true;
            $this->showValueTime = $departure['time'];
            $this->showValueDate = $departure['date'];
            $this->showValueRoute = $departure['route'];

            /****** SEARCH THE DB AND CREATE RESULTS ******/
            $meno_trasy = $departure['route'];
            $id_trasa = $departure['id_route'];

            $useky_na_trase = Usek::select(
                'usek.*',
                'zastavka.meno_zastavky',
                'planovany_spoj.id_plan_trasy',
                'planovany_spoj.zaciatok_trasy'
            )
            ->join('zastavka', 'usek.id_zastavka_zaciatok', '=', 'zastavka.id_zastavka')
            ->join('trasa', 'usek.id_trasa', '=', 'trasa.id_trasa')
            ->join('planovany_spoj', 'trasa.id_trasa', '=', 'planovany_spoj.id_trasa')
            ->where('usek.id_trasa', '=', $id_trasa)
            ->get()
            ->toArray();

            foreach ($useky_na_trase as $usek_na_trase) {
                $suma_minut = 0;
                $aktualna_zastavka = $usek_na_trase['id_zastavka_zaciatok'];

                // Cycle through all the sections of the route that goes through the current stop
                foreach ($useky_na_trase as $usek_na_trase) {
                    if ($usek_na_trase['id_zastavka_zaciatok'] == $aktualna_zastavka) {       // if the starting stop of the section equals current stop, then stop the calculation of the duration
                        break;
                    } 
                    $suma_minut += $usek_na_trase['cas_useku_minuty'];     // add the duration of the section to the entire duration of the journey
                }

                // Calculate the duration of the journey until the current stop
                $cas_prichodu_na_aktualnu_zastavku = new DateTime($usek_na_trase['zaciatok_trasy']);
                $cas_prichodu_na_aktualnu_zastavku->modify("+$suma_minut minutes");

                // Add the formatted data to the routes which are displayed in the view
                $this->routes[] = ['id_zastavka' => $usek_na_trase['id_zastavka_zaciatok'], 'stop' => $usek_na_trase['meno_zastavky'] , 'time' => $cas_prichodu_na_aktualnu_zastavku->format('H:i:s')];
            }
            /****** END SEARCH THE DB AND CREATE RESULTS ******/
        }
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-departures')]
    public function mount()
    {
        $this->departures = session()->has('departuresResults') ? session('departuresResults') : [];
    }
    
    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.search-list-departures');
    }
}
