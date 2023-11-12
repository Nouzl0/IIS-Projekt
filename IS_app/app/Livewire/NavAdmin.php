<?php

namespace App\Livewire;

use Livewire\Component;

class NavAdmin extends Component
{
    /* Variables */
    public $showMoreNav = false;        // used for dropdown menu


    /* Back-end functions */

    // redirects to the home page and logs the user out
    public function logout()
    {
        session(['userRole' => 'guest']);     // Set the userRole as guest in the session, Nav component watches the 'userRole' in the session and renders itself accordingly
        return redirect()->route('home');
    }

    /* Front-end functions */
    // toggles the dropdown menu
    public function toggleContent()
    {
        $this->showMoreNav = !$this->showMoreNav;
    }

    
    /* Rederictions */
    public function re_home() {
        return redirect()->route('home');
    }

    public function re_assignedPlan() {
        return redirect()->route('assignedPlan');
    }

    public function re_assignVehicles() {
        return redirect()->route('assignVehicles');
    }

    public function re_manageLinks() {
        return redirect()->route('manageLinks');
    }

    public function re_manageUsers() {
        return redirect()->route('manageUsers');
    }

    public function re_manageVehicles() {
        return redirect()->route('manageVehicles');
    }

    public function re_recordMaintenance() {
        return redirect()->route('recordMaintenance');
    }

    public function re_reportIssue() {
        return redirect()->route('reportIssue');
    }


    /* Render */
    public function render()
    {
        return view('livewire.nav-admin');
    }
}
