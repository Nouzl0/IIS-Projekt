<?php

namespace App\Livewire;

use Livewire\Component;

class NavManager extends Component
{
    /* Variables */
    // empty (replace when needed)


    /* Back-end functions */

    // redirects to the home page and logs the user out
    public function logout()
    {
        session(['userRole' => 'guest']);     // Set the userRole as guest in the session, Nav component watches the 'userRole' in the session and renders itself accordingly
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
