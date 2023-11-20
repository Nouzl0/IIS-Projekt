<?php

namespace App\Livewire;

use Livewire\Component;

class Timeout extends Component
{
    protected $listeners = ['logoutUser' => 'logout'];
    public $role;

    // This method handles the 'logoutUser' event and logs out the user
    public function logout()
    {
        session(['userRole' => 'guest']);     // change the users role to guest
        return redirect()->route('login');    // redirect to login page
    }

    public function render()
    {
        return view('livewire.timeout');
    }
}
