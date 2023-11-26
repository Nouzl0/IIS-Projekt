<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;

use App\Models\Trasa;
use App\Models\Linka;
use App\Models\Usek;
use App\Models\Zastavka;

class ManageLinksAddRoutes extends Component
{
    /** table from db */
    public $stops; //all stops
    public $routes;
    public $stop;
    public $lines;

    public $meno_trasy, $info_trasy, $id_linka;
    public $cislo_linky;

    public $zastavky; // new stops

    public $button_add;
    public $numRange;


    /* routeGetAll()
   DESCRIPTION:    - Function which gets all the routes from the database and formats them
                   - Returns an array of routes
   */
    private function routesGetAll()
    {
        // Retrieve all data from the DB
        $dbroutes = DB::table('trasa')->get()->toArray();
        $this->stops = DB::table('zastavka')->orderBy("meno_zastavky", 'asc')->get();

        // Initialize an empty array to store routes
        $routes = [];


        // Loop through each user and format the data
        foreach ($dbroutes as $dbRoute) {
            $stops_in_lines = Usek::where('id_trasa', $dbRoute->id_trasa)->get()->toArray();
            $routes[] = [
                'meno_trasy' => $dbRoute->meno_trasy,
                'id_linka' => $dbRoute->id_linka,
                'zastavky' => $stops_in_lines,
            ];
        }

        return $routes;
    }

    /* FUNCTIONS */

    /* routeAdd()
    DESCRIPTION:    - Function which validates and adds to the database
                    
    */
    public function routeAdd()
    {
        /** prevent create route without stops */
        if ($this->button_add) {
            $this->button_add = false;
            return;
        }

        try {
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'meno_trasy' => 'required|string|unique:trasa,meno_trasy',
                'cislo_linky' => 'required',
            ], [
                'meno_trasy.required' => 'zadaj meno trasy',
                'meno_trasy.unique' => 'nazov už existuje',
                'cislo_linky.required' => 'zvyber linku',
            ]);


            $linka_na_trase = Linka::where('cislo_linky', $this->cislo_linky)->first();
            // After successful validation, create a new vehicle with the validated data

            /** we have to have at least 2 stops to create 'usek'  */
            $zastavka_length = count($this->zastavka);
            if ($zastavka_length <= 1) {
                $this->dispatch('alert-error', message: "trasa musí mať aspoň 2 zastávky");
                return;
            }
            if ($this->cislo_linky == "") {
                $this->dispatch('alert-error', message: "vyber_linku");
                return;
            }

            /** todo if zastavka failed undo create */
            $nova_trasa = Trasa::create([
                'meno_trasy' => $validatedData['meno_trasy'],
                'id_linka' => $linka_na_trase->id_linka,
            ]);

            // dd($zastavka_length);

            for ($i = 0; $i <= $zastavka_length - 2; $i++) {
                $zaciatok = $this->zastavka[$i];
                $koniec = $this->zastavka[$i + 1];
                $dbZastavka_zaciatok = Zastavka::where('meno_zastavky', $zaciatok)->first();
                $dbZastavka_koniec = Zastavka::where('meno_zastavky', $koniec)->first();
                // dd( $dbZastavka_zaciatok->id_zastavka ,$dbZastavka_koniec->id_zastavka);
                $dlzkaU = $this->dlzka[$i];
                $casU = $this->cas[$i];


                if (($zastavka_length - $i - 1) == 1) {

                    // dd($dlzkaU);
                    if (!is_numeric($dlzkaU) || $dlzkaU <= 0) {
                        $this->routeDelete(($this->meno_trasy));
                        throw ValidationException::withMessages(['field_name' => 'dlza useku je nespravna']);
                    }
                    if (!is_numeric($casU) || $casU <= 0) {
                        $this->routeDelete(($this->meno_trasy));
                        throw ValidationException::withMessages(['field_name' => 'cas useku je nespravna']);
                    }
                }
                elseif ($i == 0) {
                    if (!is_numeric($dlzkaU) || $dlzkaU != 0) {
                        $this->routeDelete(($this->meno_trasy));
                        throw ValidationException::withMessages(['field_name' => 'prvý úsek musí mať dĺžku 0']);
                    }
                    if (!is_numeric($casU) || $casU != 0) {
                        $this->routeDelete(($this->meno_trasy));
                        throw ValidationException::withMessages(['field_name' => 'prvý úsek musí mať čas 0']);
                        
                        return;
                    }
                } else {
                    // dd($dlzkaU);
                    if (!is_numeric($dlzkaU) || $dlzkaU <= 0) {
                        $this->routeDelete(($this->meno_trasy));
                        throw ValidationException::withMessages(['field_name' => 'dlza useku je nespravna']);
                    }
                    if (!is_numeric($casU) || $casU <= 0) {
                        $this->routeDelete(($this->meno_trasy));
                        throw ValidationException::withMessages(['field_name' => 'cas useku je nespravna']);
                    }
                }

                if (($zastavka_length - $i - 1) == 1) {

                    Usek::create([
                        'id_zastavka_zaciatok' => $dbZastavka_zaciatok->id_zastavka,
                        'id_zastavka_koniec' => $dbZastavka_koniec->id_zastavka,
                        'dlzka_useku_km' => $this->dlzka[$i + 1],
                        'cas_useku_minuty' => $this->cas[$i + 1],
                        'id_trasa' => $nova_trasa->id_trasa,
                        'poradie_useku' => $i,
                    ]);
                } else {

                    Usek::create([
                        'id_zastavka_zaciatok' => $dbZastavka_zaciatok->id_zastavka,
                        'id_zastavka_koniec' => $dbZastavka_koniec->id_zastavka,
                        'dlzka_useku_km' => $dlzkaU,
                        'cas_useku_minuty' => $casU,
                        'id_trasa' => $nova_trasa->id_trasa,
                        'poradie_useku' => $i,
                    ]);
                }
            }


            // If validation fails, exception is caught and then is displayed error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
            return;

            // If there is any other exception, display basic error message
            // } catch (\Exception $e) {
            //     $this->dispatch('alert-error', message: "ERROR - zly format dat");
            //     return;
        }

        // Reset input field properties, display success message and dispatch an event to refresh the users list
        $this->reset(['meno_trasy', 'info_trasy']);
        $this->zastavka = [];
        $this->dlzka = [];
        $this->cas = [];
        $this->i = 1;

        $this->dispatch('refresh-routes-list')->to(ManageLinksListRoutes::class);
        $this->dispatch('alert-success', message: "Trasa bola pridana do databázy");
    }


      /* routeDelete()
    DESCRIPTION:    - Deletes route from database

    TODO            - remove all useky from db
     */
    private function routeDelete($id)
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

    /** add dynamic button fot stops */
    public $i;
    public $zastavka;
    public $dlzka;
    public $cas;
    // init in mount

    public function add()
    {
        // no stops in route
        if (count($this->zastavka) == 0) {
            $this->zastavka[0] = '';
            $this->dlzka[0] = '';
            $this->cas[0] = '';
            return;
        }

        // add new stop to route
        $newKey = max(array_keys($this->zastavka)) + 1;
        $this->zastavka[$newKey] = '';
        $this->dlzka[$newKey] = '';
        $this->cas[$newKey] = '';

        // re-index the arrays if needed
        $this->zastavka = array_values($this->zastavka);
        $this->dlzka = array_values($this->dlzka);
        $this->cas = array_values($this->cas);
    }


    public function remove($id)
    {
        unset($this->zastavka[$id]);
        unset($this->dlzka[$id]);
        unset($this->cas[$id]);

        // re-index the arrays if needed
        $this->zastavka = array_values($this->zastavka);
        $this->dlzka = array_values($this->dlzka);
        $this->cas = array_values($this->cas);
    }


    /** end dynamic button */
    public function mount()
    {
        $this->lines = Linka::all();
        $this->routes = $this->routesGetAll();

        /** for dynamic list */
        $this->zastavka = [];
        $this->dlzka = [];
        $this->cas = [];
        $this->i = 1;

        $this->numRange = range(0, 15);
    }

    public function render()
    {
        return view('livewire.manage-links-add-routes');
    }
}
