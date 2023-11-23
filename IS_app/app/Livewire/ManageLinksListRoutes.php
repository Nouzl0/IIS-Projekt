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
    public $routes;
    public $lines;
    public $stops;
    public $editButton = false;
    public $editValue = '';
    public $editButtonStop = false;
    public $editValueStop = '';
    public $all_stops = true;

    public $meno_trasy, $info_trasy, $id_linka;
    public $cislo_linky;

    /** add dynamic button fot stops */
    public $inputs;
    public $i;
    public $zastavka;
    public $dlzka;
    public $cas;
    public $button_add;


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



    /* userGetAll()
    DESCRIPTION:    - Function which gets all the users from the database and formats them
                    - Returns an array of users
                    
    TODO            - use/fix SESSION to get user id
                    - finish for the final version
    */
    private function routesGetAll()
    {
        // Retrieve all users from the DB
        $dbTrasy = Trasa::all();
        $this->stops = Zastavka::all();

        // Initialize an empty array to store users
        $routes = [];
        $useky = [];

        // Loop through each user and format the data
        // foreach ($stops_in_route as $usek) {
        //     $zastavka =  Zastavka::where('id_zastavka', $usek->id_zastavka_zaciatok)->first();
        // 
        //    $useky[] = [
        //         'id_zaciatok' => $usek->id_zastavka_zaciatok,
        //         'id_koniec' => $usek->id_zastavka_koniec,
        //         'zaciatok' => $zastavka->id_zastavka_zaciatok,
        //     ];
        // }
        //    $getStop = Zastavka::where('id_zastavka', $stops_in_lines[])
        //    dd($stops_in_lines);

        foreach ($dbTrasy as $dbRoute) {
            $aktualny_usek = Usek::where('id_trasa', $dbRoute->id_trasa)->get()->toArray();
            $zastavky_zaciatok = array_column($aktualny_usek, 'id_zastavka_zaciatok');
            $zastavky_koniec = array_column($aktualny_usek, 'id_zastavka_koniec');
            $dlzkaU = array_column($aktualny_usek, 'dlzka_useku_km');
            $casU = array_column($aktualny_usek, 'cas_useku_minuty');
            $vsetky_zastavky = [];
            $i = -1;
            
            foreach ($zastavky_zaciatok as $zastavka) {
                $meno_zastavok = [];        
                $meno_zastavky = Zastavka::where('id_zastavka', $zastavka)->first();
                array_push($meno_zastavok, $meno_zastavky->meno_zastavky);
                if($i < 0) {
                    array_push($meno_zastavok, 0);
                    array_push($meno_zastavok, 0);
                }else {
                    array_push($meno_zastavok, $dlzkaU[$i]);
                    array_push($meno_zastavok, $casU[$i]);
                }
                array_push($vsetky_zastavky, $meno_zastavok);
                $i = $i + 1;
                // dd($vsetky_zastavky);
            }
            $meno_zastavok = [];
            $meno_poslednej_zastavky = Zastavka::where('id_zastavka', end($zastavky_koniec))->first();
            if ($meno_poslednej_zastavky != null) {

                array_push($meno_zastavok, $meno_poslednej_zastavky->meno_zastavky);
                array_push($meno_zastavok, $dlzkaU[$i]);
                array_push($meno_zastavok, $casU[$i]);
                array_push($vsetky_zastavky, $meno_zastavok);
            }

            // dd($meno_zastavok);
            $aktual_linka =  Linka::where('id_linka', $dbRoute->id_linka)->first();
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

    /* userSave()
    DESCRIPTION:    - Function which validates and updates a user in the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManageUsersList' to refresh the user's list
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
        // dd($this->cislo_linky);
        $linka_na_trase = Linka::where('cislo_linky', $this->cislo_linky)->first();
        // dd($linka_na_trase->cislo_linky, $linka_na_trase->id_linka);
        Trasa::where('meno_trasy', $id)->update([
            'meno_trasy' => $this->meno_trasy,
            'info_trasy' => $this->info_trasy,
            'id_linka' => $linka_na_trase->id_linka,

        ]);
        // return redirect()->to('/manageLinks');   // refresh the page

        $this->editButton = false;
        $this->mount();

        // if ($this->cislo_linky == "") {
        //     $this->dispatch('alert-error', message: "vyber_linku");
        //     return;
        // }
    }

    /* userEdit()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
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

            // Fill the input fields with the current user data
            $trasa = DB::table('trasa')->where('meno_trasy', '=', $id)->first();
            $this->meno_trasy = $trasa->meno_trasy;
            $this->info_trasy = $trasa->info_trasy;
            $this->id_linka = $trasa->id_linka;

            // get cislo linky from Linka using id_linka
            $newLinka = Linka::where('id_linka', $trasa->id_linka)->first();
            $this->cislo_linky = $newLinka->cislo_linky;
        }
    }

    public function hide_all_stops() {
        if ($this->all_stops === true) {
            $this->all_stops = false;
        } else {
            $this->all_stops = true;
        }
    }
    
    public $edit_stops = [];

    public function stopInRouteEdit($id) {
        if ($this->editButtonStop && $this->editValueStop === $id) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButtonStop = false;
            $this->editValueStop = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->editButtonStop = true;
            $this->editValueStop = $id;

            dd($this->edit_stops);

            // Fill the input fields with the current user data
            // $trasa = DB::table('trasa')->where('meno_trasy', '=', $id)->first();
            // $this->meno_trasy = $trasa->meno_trasy;
            // $this->info_trasy = $trasa->info_trasy;
            // $this->id_linka = $trasa->id_linka;

            // get cislo linky from Linka using id_linka
            // $newLinka = Linka::where('id_linka', $trasa->id_linka)->first();
            // $this->cislo_linky = $newLinka->cislo_linky;
        }
    }

    public function routeDelete($id)
    {
        DB::table('trasa')->where('meno_trasy', '=', $id)->delete();
        $this->dispatch('alert-success', message: "Užívateľ bol odstránený z databázy");
        $this->mount();
    }

    public function mount()
    {

        $this->routes = $this->routesGetAll();
        $this->lines = Linka::all();

        $this->lines = Linka::all();
        $this->routes = $this->routesGetAll();

        $this->inputs = [];
        $this->zastavka = [];
        $this->dlzka = [];
        $this->cas = [];
        $this->i = 1;
    }


    public function render()
    {
        return view('livewire.manage-links-list-routes');
    }
}
