<?php

namespace App\Livewire;

use App\Models\Uzivatel;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    // This method handles the data from the login form
    public function login()
    {
        $this->validate(['username' => 'required', 'password' => 'required']);

        // Retrieve the user from the database on the provided username
        $user = Uzivatel::where('uzivatelske_meno', $this->username)->first();

        // Check if the user exists and the provided password matches the one in the database
        if ($user && Hash::check($this->password, $user->heslo_uzivatela)) {
            session()->flash('message','Login successful');     // show success message on the view
            session(['userRole' => $user->rola_uzivatela]);     // store user role in session
            session(['userName' => $user->uzivatelske_meno]);   // store username in session
            return redirect()->route('home');                   // redirect the user to home page
        } else {
            session()->flash('message','Invalid username or password'); // show invalid login message on the view
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
