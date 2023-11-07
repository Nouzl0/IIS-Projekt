<?php

namespace App\Livewire;

use Livewire\Component;

class Nav extends Component
{   

    public string $role = "admin"; 

    public function render()
    {
        return view('livewire.nav');
    }

    /* 
    DESCRIPTION: this function is going to figure out which role the user is
    and then it will set the $role variable to that role. This function is
    called automatically when the component is loaded and is already set up
    in the front end. Remove this comment when you are done.
     - - - -
    TODO: connect with the database to get the role of signed in user
     - - - -
    ROLES: admin, manager, dispatcher, driver, technician, guest
    */
    public function mount()
    {   
        // temporary solution
        //$this->role = "guest";
    }
}
