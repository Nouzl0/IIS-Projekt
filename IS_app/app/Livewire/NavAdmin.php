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

    /* User */
    public function re_home() {
        return redirect()->route('home');
    }

    /* Driver (vodič)*/
    public function re_assignedPlan() {
        return redirect()->route('assignedPlan');
    }

    public function re_reportIssue() {
        return redirect()->route('reportIssue');
    }

    /* Dispatcher (dispečer)*/
    public function re_assignVehicles() {
        return redirect()->route('assignVehicles');
    }

    /* Technician (technik)*/
    public function re_recordMaintenance() {
        return redirect()->route('recordMaintenance');
    }

    /* Manager (správca)*/
    public function re_manageLinks() {
        return redirect()->route('manageLinks');
    }
    
    public function re_scheduleRoutes() {
        return redirect()->route('scheduleRoutes');
    }

    public function re_manageVehicles() {
        return redirect()->route('manageVehicles');
    }

    public function re_organizeMaintenance() {
        return redirect()->route('organizeMaintenance');
    }
    
    /* Admin (administrátor)*/
    public function re_manageUsers() {
        return redirect()->route('manageUsers');
    }


    /* Render */
    public function render()
    {
        return view('livewire.nav-admin');
    }
}
