<?php

namespace App\Livewire;

use App\Models\Uzivatel;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    // This method handles the data from the login form
    public function login()
    {
        $this->validate(['email' => 'required|string', 'password' => 'required|string']);

        // Retrieve the user from the database on the provided username
        $user = Uzivatel::where('email_uzivatela', $this->email)->first();

        // Check if the user exists and the provided password matches the one in the database
        if ($user && Hash::check($this->password, $user->heslo_uzivatela)) {
            $this->dispatch('alert-success', message: "Prihlásenie bolo úspešné"); // show success message on the view
            session(['userRole' => $user->rola_uzivatela]);              // store user role in session
            session(['userName' => $user->uzivatelske_meno]);            // store username in session
            session(['userFirstName' => $user->meno_uzivatela]);         // store user's first name in session
            session(['userLastName' => $user->priezvisko_uzivatela]);    // store user's last name in session
            session(['userEmail' => $user->email_uzivatela]);            // store user email in session

            return redirect()->route('home');                   // redirect the user to home page
        } else {
            $this->dispatch('alert-error', message: "Nesprávny e-mail alebo heslo"); // show invalid login message on the view
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
