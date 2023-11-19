<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

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
            $this->routes = [
                0 => ['stop' => 'Skácelová', 'time' => 'xx:43'],
                1 => ['stop' => 'Semilasso', 'time' => 'xx:53'],
                2 => ['stop' => 'Královo Pole', 'time' => 'xx:03'],
            ];
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
