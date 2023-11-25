<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

use App\Models\Linka;
use Livewire\Component;
use App\Models\Trasa;
use App\Models\Usek;
use App\Models\Zastavka;
use Illuminate\Validation\ValidationException;


class ManageLinksListRoutes extends Component
{
    /** Data from db */
    public $routes;
    public $lines;
    public $stops;

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

    /* Edit Toggle */
    public $editButton = false;
    public $editValue = '';

    /* Show Toggle */
    public $showButton = false;
    public $showValue = '';

    /* Route Input-Field */
    public $meno_trasy;
    public $id_linka;

    /* Stop Input-Field */
    public $sectionStop = [];
    public $sectionLength = [];
    public $sectionTime = [];


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
    
    TODO            - save given data do db
    */
    public function routeSave($id)
    {
        // TODO - FINISH DATABESE UPDATE, DEBUG HERE
        // dd("Finish routeSave()", $this->sectionStop, $this->sectionLength, $this->sectionTime);


        try {
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'meno_trasy' => 'required|string|unique:trasa,meno_trasy,' . $id . ',meno_trasy',
            ], [
                'meno_trasy.required' => 'zadaj meno trasy',
                'meno_trasy.unique' => 'Názov musí byť unikatny',
            ]);

            /** udate Trasa */
            $linka_na_trase = Linka::where('cislo_linky', $this->cislo_linky)->first();
            // dd($linka_na_trase->cislo_linky, $linka_na_trase->id_linka);
            Trasa::where('meno_trasy', $id)->update([
                'meno_trasy' => $validatedData['meno_trasy'],
                'id_linka' => $linka_na_trase->id_linka,

            ]);

            /** EDIT STOPS */

            /** delete all Usek with Trasa id */
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

            if (!is_numeric($this->sectionLength[0]) || $this->sectionLength[0] != 0 || !is_numeric($this->sectionTime[0]) || $this->sectionTime[0] != 0) {
                throw ValidationException::withMessages(['field_name' => ' usek začína nulou']);
            }

            for ($i = 0; $i <= $numberOfStops - 2; $i++) {
                $zaciatok = $this->sectionStop[$i];
                $koniec = $this->sectionStop[$i + 1];
                $dbZastavka_zaciatok = Zastavka::where('meno_zastavky', $zaciatok)->first();
                $dbZastavka_koniec = Zastavka::where('meno_zastavky', $koniec)->first();
                // dd( $dbZastavka_zaciatok->id_zastavka ,$dbZastavka_koniec->id_zastavka);
                $dlzka_useku = $this->sectionLength[$i + 1];
                $cas_useku = $this->sectionTime[$i + 1];


                if (!is_numeric($dlzka_useku) || $dlzka_useku <= 0) {
                    throw ValidationException::withMessages(['field_name' => 'dlza useku je nespravna']);
                }
                if (!is_numeric($cas_useku) || $cas_useku <= 0) {
                    throw ValidationException::withMessages(['field_name' => 'dlza useku je nespravna']);
                }

                Usek::create([
                    'id_zastavka_zaciatok' => $dbZastavka_zaciatok->id_zastavka,
                    'id_zastavka_koniec' => $dbZastavka_koniec->id_zastavka,
                    'dlzka_useku_km' => $dlzka_useku,
                    'cas_useku_minuty' => $cas_useku,
                    'id_trasa' => $aktualnaTrasa->id_trasa,
                    'poradie_useku' => $i + 1,
                ]);
            }



            // toggleoff edit, dispatch event amd display success message
            $this->editButton = false;
            // $this->dispatch('refresh-users-list')->to(ManageUsersList::class);
            $this->dispatch('alert-success', message: "Užívateľ bol úspešne aktualizovaný");

            // If validation fails, exception is caught and then is displayed error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
            return;

            // If there is any other exception, display basic error message
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Validation failed");
            return;
        }

        return redirect()->to('/manageLinks');   // refresh the page

    }

    /* routeEdit()
    DESCRIPTION:    - Function which toggles the edit option 
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
                    - Function is finished 
    */
    public function routeEdit($id)
    {
        if ($this->editButton && $this->editValue === $id) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {

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
            $this->id_linka = $trasa->id_linka;
            $this->id_trasa = $trasa->id_trasa;

            // get cislo linky from Linka using id_linka
            $newLinka = Linka::where('id_linka', $trasa->id_linka)->first();
            $this->cislo_linky = $newLinka->cislo_linky;

            // toggle off show and turn on edit
            $this->editButton = true;
            $this->editValue = $id;
            $this->showButton = false;
        }
    }

    /* routeEditDelete()
    DESCRIPTION:    - Function is finished  
    */
    public function routeEditDelete($id)
    {
        unset($this->sectionStop[$id]);
        unset($this->sectionLength[$id]);
        unset($this->sectionTime[$id]);

        // Optionally, you can re-index the arrays if needed
        $this->sectionStop = array_values($this->sectionStop);
        $this->sectionLength = array_values($this->sectionLength);
        $this->sectionTime = array_values($this->sectionTime);
    }

    /* routeEditAdd()
    DESCRIPTION:    - Function is finished   
    */
    public function routeEditAdd()
    {
        $newKey = max(array_keys($this->sectionStop)) + 1;

        $this->sectionStop[$newKey] = '';
        $this->sectionLength[$newKey] = '';
        $this->sectionTime[$newKey] = '';
    }

    /* routeShow()
    DESCRIPTION:    - Function is finished 
    */
    public function routeShow($id)
    {
        if ($this->showButton && $this->showValue === $id) {
            // If the button is already in show mode for the current user, turn it off
            $this->showButton = false;
            $this->showValue = '';
        } else {
            // If the button is not in show mode or is in show mode for a different user, turn it on
            $this->editButton = false;
            $this->showButton = true;
            $this->showValue = $id;
        }
    }

    /* routeDelete()
    DESCRIPTION:    - Deletes route from database

    TODO            - remove all useky from db
     */
    public function routeDelete($id)
    {
        try {
            // Removes all (úseky) from DB
            $id_trasy = Trasa::where('meno_trasy', $id)->first();
            $id_trasy = $id_trasy->id_trasa;
            DB::table('usek')->where('id_trasa', '=', $id_trasy)->delete();

            // Removes route from DB
            DB::table('trasa')->where('meno_trasy', '=', $id)->delete();

            // Displays success message and refreshes the users list
            $this->dispatch('alert-success', message: "Užívateľ bol odstránený z databázy");
            $this->dispatch('refresh-routes-list')->to(ManageLinksListRoutes::class);

            // Internal error => display error message
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "Chyba v databáze, kontaktujte administrátora o chybe");
            return;
        }
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-routes-list')]
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

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.manage-links-list-routes');
    }
}
