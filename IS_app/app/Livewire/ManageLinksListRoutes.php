<?php

namespace App\Livewire;

use App\Models\Linka;
use Livewire\Component;
use App\Models\Trasa;
use App\Models\Usek;
use App\Models\Zastavka;
use Illuminate\Support\Facades\DB;



class ManageLinksListRoutes extends Component
{
    /** table from db */
    public $routes;
    public $lines;
    public $stops;

    /** buttion, edit */
    public $editButton = false;
    public $editValue = '';
    public $all_stops = true;

    
    public $meno_trasy, $info_trasy, $id_linka;
    public $id_trasa;
    public $cislo_linky;

    /** add dynamic button fot stops */
    public $inputs;
    public $i;
    public $zastavka;
    public $dlzka;
    public $cas;
    public $button_add;

    public $numRange;


    /* edit stops*/
    public $sectionStop = [];
    public $sectionLength = [];
    public $sectionTime = [];

    /** dynamic button functions */
    public function add($i)
    {
        $this->button_add = true;
        $this->i = $i + 1;
        if ($this->inputs != "") {
            array_push($this->inputs, $i);
        }
    }

    public function remove($key)
    {
        $this->button_add = true;
        unset($this->inputs[$key]);
    }

    /** end dynamic button */

    /* routesGetAll()
    DESCRIPTION:    - Function which gets all the data from the database and formats them
                    - Returns an array of users
                    
    TODO            - refresh components
    */
    private function routesGetAll()
    {
        // Retrieve all routes and stops from the DB
        $dbTrasy = Trasa::all();
        $this->stops = DB::table('zastavka')->orderBy("meno_zastavky", 'asc')->get();

        $this->lines = Linka::all();


        // Initialize an empty array to store routes
        $routes = [];

        foreach ($dbTrasy as $dbRoute) {
            $aktualny_usek = Usek::where('id_trasa', $dbRoute->id_trasa)->get()->toArray();
            $zastavky_zaciatok = array_column($aktualny_usek, 'id_zastavka_zaciatok');
            $zastavky_koniec = array_column($aktualny_usek, 'id_zastavka_koniec');
            $dlzkaU = array_column($aktualny_usek, 'dlzka_useku_km');
            $casU = array_column($aktualny_usek, 'cas_useku_minuty');
            $poradieU = array_column($aktualny_usek, 'poradie_useku');
            $vsetky_zastavky = [];
            $i = 0;

            /** add to beginning 0 */
            array_unshift($dlzkaU, 0);
            array_unshift($casU, 0);
            array_unshift($poradieU, 0);

            /** fill up arrays with data from beginning stops in route*/
            foreach ($zastavky_zaciatok as $zastavka) {
                $meno_zastavok = [];
                $meno_zastavky = Zastavka::where('id_zastavka', $zastavka)->first();
                array_push($meno_zastavok, $meno_zastavky->meno_zastavky);
                array_push($meno_zastavok, $dlzkaU[$i]);
                array_push($meno_zastavok, $casU[$i]);
                array_push($meno_zastavok, $poradieU[$i]);
                array_push($vsetky_zastavky, $meno_zastavok);
                $i = $i + 1;
            }
            $meno_zastavok = [];
            $meno_poslednej_zastavky = Zastavka::where('id_zastavka', end($zastavky_koniec))->first();
            if ($meno_poslednej_zastavky != null) {
                array_push($meno_zastavok, $meno_poslednej_zastavky->meno_zastavky);
                array_push($meno_zastavok, $dlzkaU[$i]);
                array_push($meno_zastavok, $casU[$i]);
                array_push($meno_zastavok, $poradieU[$i]);

                array_push($vsetky_zastavky, $meno_zastavok);
            }

            $aktual_linka =  Linka::where('id_linka', $dbRoute->id_linka)->first();

            /** return data from db in array */
            $routes[] = [
                'meno_trasy' => $dbRoute->meno_trasy,
                'info_trasy' => $dbRoute->info_trasy,
                'id_linka' => $dbRoute->id_linka,
                'cislo_linky' => $aktual_linka->cislo_linky,
                'zastavky' => $vsetky_zastavky,
            ];
        }

        return $routes;
    }

    /* routeSave()
    DESCRIPTION:    - Function which validates and updates data in the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component '' to refresh the user's list
    */
    public function routeSave($id)
    {
        // try { 
        //     // Validate input fields with custom error messages
        //     $validatedData = $this->validate([
        //         'meno_trasy' => 'required|string',
        //         'info_trasy' => 'required|string',
        //         'cislo_linky'=> 'required',
        //     ], [
        //         'meno_trasy.required' => 'zadaj meno trasy',
        //         'info_trasy.required' => 'zadaj informácie o trase',
        //         'cislo_linky.required' => 'vyber linku',
        //     ]);


        //     $linka_na_trase = Linka::where('cislo_linky', $this->cislo_linky)->first();
        //     Trasa::where('meno_trasy', $id)->update([
        //         'meno_trasy' => $validatedData['meno_trasy'],
        //         'info_trasy' => $validatedData['info_trasy'],
        //         'cislo_linky' => $linka_na_trase->id_linka,

        //     ]);

        //     // toggleoff edit, dispatch event amd display success message
        //     $this->editButton = false;
        //     // $this->dispatch('refresh-users-list')->to(ManageUsersList::class);
        //     $this->dispatch('alert-success', message: "Užívateľ bol úspešne aktualizovaný");
        //     return;

        // // If validation fails, exception is caught and then is displayed error messages
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     $messages = $e->validator->getMessageBag()->all();
        //     foreach ($messages as $message) {
        //         $this->dispatch('alert-error', message: $message);
        //     }
        //     return;

        // // If there is any other exception, display basic error message
        // } catch (\Exception $e) {
        //     $this->dispatch('alert-error', message: "ERROR - Validation failed");
        //     return;
        // }

        /** udate Trasa */
        $linka_na_trase = Linka::where('cislo_linky', $this->cislo_linky)->first();
        // dd($linka_na_trase->cislo_linky, $linka_na_trase->id_linka);
        Trasa::where('meno_trasy', $id)->update([
            'meno_trasy' => $this->meno_trasy,
            'info_trasy' => $this->info_trasy,
            'id_linka' => $linka_na_trase->id_linka,

        ]);

        /** EDIT STOPS */

        /** delete all Usek with Trasa id */
        try {

        $aktualnaTrasa = Trasa::where('meno_trasy', $id)->first();
        Usek::where('id_trasa', $aktualnaTrasa->id_trasa)->delete();

        /** add to edited sectionStop/length/time new stops */
        $numberOfNewStops = count($this->zastavka);
        for ($j = 0; $j < $numberOfNewStops; $j++) {
            array_push($this->sectionStop, $this->zastavka[$j]);
            array_push($this->sectionLength, $this->dlzka[$j]);
            array_push($this->sectionTime, $this->cas[$j]);
        }

        /** insert new stops */
        $numberOfStops = count($this->sectionStop);
        if ($numberOfStops <= 1) {
            $this->dispatch('alert-error', message: "trasa musí mať aspoň 2 zastávky");
            return;
        }

        for ($i = 0; $i <= $numberOfStops - 2; $i++) {
            $zaciatok = $this->sectionStop[$i];
            $koniec = $this->sectionStop[$i + 1];
            $dbZastavka_zaciatok = Zastavka::where('meno_zastavky', $zaciatok)->first();
            $dbZastavka_koniec = Zastavka::where('meno_zastavky', $koniec)->first();
            // dd( $dbZastavka_zaciatok->id_zastavka ,$dbZastavka_koniec->id_zastavka);

                Usek::create([
                    'id_zastavka_zaciatok' => $dbZastavka_zaciatok->id_zastavka,
                    'id_zastavka_koniec' => $dbZastavka_koniec->id_zastavka,
                    'dlzka_useku_km' => $this->sectionLength[$i + 1],
                    'cas_useku_minuty' => $this->sectionTime[$i + 1],
                    'id_trasa' => $aktualnaTrasa->id_trasa,
                    'poradie_useku' => $i + 1,
                ]);
            } 
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Nesprávne údaje");
            return;
        } 



        $this->editButton = false;
        return redirect()->to('/manageLinks');   // refresh the page

    }

    /* routeEdit()
    DESCRIPTION:    - Function which toggles the edit option 
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function routeEdit($id)
    {
        if ($this->editButton && $this->editValue === $id) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->editButton = true;
            $this->editValue = $id;

            /** fill up section data */
            $this->sectionStop = [];
            $this->sectionLength = [];
            $this->sectionTime = [];

            foreach ($this->routes as $route) {
                if ($route['meno_trasy'] === $id) {
                    // dd($route['zastavky']);
                    $this->sectionStop = array_column($route['zastavky'], 0);
                    $this->sectionLength = array_column($route['zastavky'], 1);
                    $this->sectionTime = array_column($route['zastavky'], 2);
                }
            }

            // Fill the input fields with the current user data
            $trasa = DB::table('trasa')->where('meno_trasy', '=', $id)->first();
            $this->meno_trasy = $trasa->meno_trasy;
            $this->info_trasy = $trasa->info_trasy;
            $this->id_linka = $trasa->id_linka;
            $this->id_trasa = $trasa->id_trasa;

            // get cislo linky from Linka using id_linka
            $newLinka = Linka::where('id_linka', $trasa->id_linka)->first();
            $this->cislo_linky = $newLinka->cislo_linky;
        }
    }

    /**
     * not working
     */
    public function hide_all_stops()
    {
        if ($this->all_stops === true) {
            $this->all_stops = false;
        } else {
            $this->all_stops = true;
        }
    }

    /**
     * delete route
     */
    public function routeDelete($id)
    {
        try {            
            DB::table('trasa')->where('meno_trasy', '=', $id)->delete();
            $this->dispatch('alert-success', message: "Užívateľ bol odstránený z databázy");
            $this->mount();
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR -  Nemôžeš vymazať trasu");
            return;
        } 

    }

    public function mount()
    {
        $this->routes = $this->routesGetAll();

        /** init data for dynamic input list */
        $this->inputs = [];
        $this->zastavka = [];
        $this->dlzka = [];
        $this->cas = [];
        $this->i = 1;

        $this->numRange = range(0, 15);

    }


    public function render()
    {
        return view('livewire.manage-links-list-routes');
    }
}
