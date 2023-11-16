<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PlanovanySpoj;
use App\Models\Vozidlo;
use App\Models\Uzivatel;
use App\Models\Trasa;

class AssignedPlanList extends Component
{

     /* ATRIBUTES */

     

    /* All users property */
    public $plans;

  


    /* FUNCTIONS */

    /* userGetAll()
    DESCRIPTION:    - Function which gets all the users from the database and formats them
                    - Returns an array of users
    TODO            - use SESSION to get user id
    */
    private function userGetAll()
    {
        // Retrieve all users from the DB
        $dbSpoje = PlanovanySpoj::all();

        

        // Initialize an empty array to store users
        $spoje = [];

        // Loop through each user and format the data
        foreach ($dbSpoje as $dbSpoj) {
            $vehicle_name = Vozidlo::where('id_vozidlo', $dbSpoj->id_vozidlo)->first();
            $route_name = Trasa::where('id_trasa', $dbSpoj->id_trasa)->first();
            $assigned_name = Vozidlo::where('id_uzivatel', $dbSpoj->id_uzivatel_dispecer)->first();
            $spoje[] = [
                'beginning' => $dbSpoj->zaciatok_trasy,
                'rout' => $route_name->meno_trasy,
                'vehicle' => $vehicle_name->spz,
                'assigned' => $assigned_name->priezvisko_uzivatela,
            ];
        }

        return $spoje;
    }



    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    public function mount()
    {
        // Set the $users property with the formatted users array
        $this->plans = $this->userGetAll();
    }
    


    public function render()
    {
        return view('livewire.assigned-plan-list');
    }
}
