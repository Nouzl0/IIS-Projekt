<?php

namespace App\Livewire;

use Livewire\Component;

class NavManager extends Component
{
    /* Variables */
    // empty (replace when needed)


    /* Back-end functions */
    public function get_login()
    {
        return "admin_acount";
    }

    // redirects to the home page and logs the user out
    // todo - work on functionality
    public function logout()
    {
        return redirect()->route('home');
    }


    /* Front-end functions */
    // empty (replace when needed)



    /* rederictions */
    public function re_home()
    {
        return redirect()->route('home');
    }

    public function re_manageLinks() {
        return redirect()->route('manageLinks');
    }

    public function re_manageVehicles() {
        return redirect()->route('manageVehicles');
    }

    /* render */
    public function render()
    {
        return view('livewire.nav-manager');
    }
}
