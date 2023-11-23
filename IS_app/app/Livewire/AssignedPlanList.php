<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PlanovanySpoj;
use App\Models\Uzivatel;

class AssignedPlanList extends Component
{
     /* ATRIBUTES */

    /* All users property */
    public $plans = []; 


    /* FUNCTIONS */

    /* userGetAll()
    DESCRIPTION:    - Function which gets all the users from the database and formats them
                    - Returns an array of users
    */
    private function userGetAll()
    {
        // Get information from the database about the currently logged user
        $aktualny_uzivatel = Uzivatel::where('email_uzivatela', '=', session('userEmail'))->first();
        if (is_null($aktualny_uzivatel)) {
            return [];
        }

        // Get all assigned scheduled routes for the current user with additional information from the database
        $db_priradene_spoje = PlanovanySpoj::select(
            'planovany_spoj.*',
            'trasa.meno_trasy',
            'linka.cislo_linky',
            'vozidlo.spz',
            'vozidlo.nazov',
            'vozidlo.druh_vozidla'
        )
        ->join('trasa', 'planovany_spoj.id_trasa', '=', 'trasa.id_trasa')
        ->join('linka', 'trasa.id_linka', '=', 'linka.id_linka')
        ->join('vozidlo', 'planovany_spoj.id_vozidlo', '=', 'vozidlo.id_vozidlo')
        ->where('planovany_spoj.id_uzivatel_sofer', '=', $aktualny_uzivatel->id_uzivatel)
        ->where('planovany_spoj.platny_do', '>=', date('Y-m-d H:i:s'))
        ->get()
        ->toArray();

        // Array for the formatted data that are displayed on the view
        $priradene_spoje = [];

        // Cycle through all assigned scheduled routes and format the data for the view
        foreach ($db_priradene_spoje as $db_priradeny_spoj) {
            $datum_cas = explode(' ', $db_priradeny_spoj['zaciatok_trasy']);
            $datum_dnes = date('d.m.Y');
            $cas_zaciatku_spoja = $datum_cas[1];

            $priradene_spoje[] = [
                'zaciatok' => $datum_dnes . ' - ' . $cas_zaciatku_spoja,
                'cislo_linky' => $db_priradeny_spoj['cislo_linky'],
                'meno_trasy' => $db_priradeny_spoj['meno_trasy'],
                'vozidlo_spz' => $db_priradeny_spoj['spz'],
                'vozidlo_nazov' => $db_priradeny_spoj['nazov'],
                'vozidlo_druh_vozidla' => $db_priradeny_spoj['druh_vozidla']
            ];
        }

        return $priradene_spoje;
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    public function mount()
    {
        // Set the $users property with the formatted users array
        $this->plans = $this->userGetAll();
    }

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.assigned-plan-list');
    }
}
