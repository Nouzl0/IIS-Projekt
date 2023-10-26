<?php

namespace App\Livewire;

use Livewire\Component;

class LoginNav extends Component
{
    public function render()
    {
        return view('livewire.login-nav');
    }

    public function login()
    {
        return redirect()->route('login');
    }
}
