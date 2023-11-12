<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Nav extends Component
{   

    public string $role = "guest"; 

    public function render()
    {
        return view('livewire.nav');
    }

    
    /* 
    This function is the constructor of the component and it also retrieves 
    the role of the user from the session and sets the $role attribute to that role.
    Notes:  - the 'userRole' key and value in session is created after a successful login in Login.php file. 
            - this component only watches the 'userRole' and renders itself accordingly.
    Roles: admin, manager, dispatcher, driver, technician, guest
    */
    public function mount()
    {   
        // Retrieve user role from session and update the component
        $this->role = session('userRole', 'guest');

        // Convert role to a format suitable for the view(nav.blade.php)
        switch ($this->role) {
            case 'administrátor':
                $this->role = 'admin';
                break;
            case 'správca':
                $this->role = 'manager';
                break;
            case 'dispečer':
                $this->role = 'dispatcher';
                break;
            case 'vodič':
                $this->role = 'driver';
                break;
            case 'technik':
                $this->role = 'technician';
                break;
            default:
                $this->role = 'guest';        
        }
    }
}
