<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use App\Models\Usek;


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
    public function departureShow($time, $date, $route)
    {
        if ($this->showButton && ($this->showValueTime === $time) && ($this->showValueDate === $date) && ($this->showValueRoute === $route)) {
            // If the button is already in show mode for the current search, turn it off
            $this->showButton = false;
            $this->showValueTime = '';
            $this->showValueDate = '';
            $this->showValueRoute = '';
        } else {
            // If the button is not in show mode or is in show mode for a different serach, turn it on
            $this->showButton = true;
            $this->showValueTime = $time;
            $this->showValueDate = $date;
            $this->showValueRoute = $route;

            /* TODO - Display the route data with given time and date, code bellow is just for testing
            */
            /* $this->routes = [
                0 => ['stop' => 'Skácelová', 'time' => 'xx:43'],
                1 => ['stop' => 'Semilasso', 'time' => 'xx:53'],
                2 => ['stop' => 'Královo Pole', 'time' => 'xx:03'],
            ]; */

            foreach ($this->departures as $departure) {
                $meno_trasy = $departure['route'];
                $id_trasa = $departure['id_route'];

                //$useky_na_trase = Usek::where('id_trasa', '=', $id_trasa)->get()->toArray();   // retrieve all sections of that route
                //dd($useky_na_trase);

                $useky_na_trase = Usek::select(
                    'usek.*',
                    'zastavka.meno_zastavky'
                )
                ->join('zastavka', 'usek.id_zastavka_zaciatok', '=', 'zastavka.id_zastavka')
                ->where('id_trasa', '=', $id_trasa)
                ->get()
                ->toArray();

                //dd($useky_na_trase);

                // join Usek a zastavka (zastavka_zaciatok)
                // dva foreach, prvy len na meno_zastavky a id_zastavka, druhy na cas v danej zastavke
                foreach ($useky_na_trase as $usek_na_trase) {
                    $this->routes[] = ['id_zastavka' => $usek_na_trase['id_zastavka_zaciatok'], 'stop' => $usek_na_trase['meno_zastavky'] , 'time' => '??'];
                    //$this->routes[$usek_na_trase['id_zastavka_zaciatok']] = ['stop' => $usek_na_trase['meno_zastavky']];
                }
                //dd($this->routes);

                foreach ($this->routes as $zastavka) {
                    /* foreach ($useky_na_trase as $usek_na_trase) {
                        if ($usek_na_trase['id_zastavka_zaciatok'] == $vybrata_zastavka['id_zastavka']) {       // if the starting stop of the section equals selected stop, then stop the calculation of the duration
                            break;
                        } 
                        $suma_minut += $usek_na_trase['cas_useku_minuty'];     // add the duration of the section to the entire duration of the journey
                    } */
                    $suma_minut = 0;
                    foreach ($useky_na_trase as $usek_na_trase) {
                        //dd($usek_na_trase);
                        if ($usek_na_trase['id_zastavka_zaciatok'] == $zastavka['id_zastavka']) {
                            break;
                        }
                        $suma_minut += $usek_na_trase['cas_useku_minuty'];
                    }

                }
            }
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
