<?php

namespace App\Livewire;

use Livewire\Component;

class NavLogin extends Component
{    
    /* Variables */
    // empty (replace when needed)


    /* Back-end functions */
    // empty (replace when needed)


    /* Front-end functions */
    // empty (replace when needed)


    /* rederictions */
    public function re_login()
    {
        return redirect()->route('login');
    }

    public function re_home()
    {
        return redirect()->route('home');
    }

    /* render */
    public function render()
    {
        return view('livewire.nav-login');
    }
}
