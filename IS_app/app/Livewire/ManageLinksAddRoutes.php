<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;
use App\Models\Trasa;
use App\Models\Linka;
use App\Models\Usek;
use App\Models\Zastavka;
use Livewire\Component;

class ManageLinksAddRoutes extends Component
{
    // public $route_name, $info;
    public $meno_trasy, $info_trasy, $id_linka;
    public $stop;
    public $stops; //all stops
    public $cislo_linky;

    public $zastavky;

    public $button_add;
    
    public $lines;

    public $stops_in_route;
    
    public $routes;


     /* userGetAll()
    DESCRIPTION:    - Function which gets all the users from the database and formats them
                    - Returns an array of users
    */
    // private function stopsGetAll($id_trasa)
    // {
    //     // Retrieve all users from the DB
    //     $dbUsers = DB::table('uzivatel')->get()->toArray();

    //     // Initialize an empty array to store users
    //     $users = [];

    //     // Loop through each user and format the data
    //     foreach ($dbUsers as $dbUser) {
    //         $users[] = [
    //             'firstName' => $dbUser->meno_uzivatela,
    //             'lastName' => $dbUser->priezvisko_uzivatela,
    //             'email' => $dbUser->email_uzivatela,
    //             'password' => $dbUser->heslo_uzivatela,
    //             'role' => $dbUser->rola_uzivatela,
    //         ];
    //     }

    //     return $users;
    // }
    
    
    /* userGetAll()
   DESCRIPTION:    - Function which gets all the users from the database and formats them
                   - Returns an array of users
   */
   private function routesGetAll()
   {
       // Retrieve all users from the DB
       $dbroutes = DB::table('trasa')->get()->toArray();
       $this->stops = Zastavka::all();

       // Initialize an empty array to store routes
       $routes = [];

       
       // Loop through each user and format the data
       foreach ($dbroutes as $dbRoute) {
           $stops_in_lines = Usek::where('id_trasa', $dbRoute->id_trasa)->get()->toArray();
        //    $getStop = Zastavka::where('id_zastavka', $stops_in_lines[])
        //    dd($stops_in_lines);
           $routes[] = [
               'meno_trasy' => $dbRoute->meno_trasy,
               'info_trasy' => $dbRoute->info_trasy,
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
        /** prevent create rout without stops */
        if ($this->button_add) {
            $this->button_add = false;
            return;
        }
        // dd($this->zastavka[0]);
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'meno_trasy' => 'required|string|unique:trasa,meno_trasy',
                'info_trasy' => 'required|string',
                'cislo_linky'=> 'required',
            ], [
                'meno_trasy.required' => 'zadaj meno trasy',
                'meno_trasy.unique' => 'nazov už existuje',
                'info_trasy.required' => 'zadaj informácie o trase',
                'cislo_linky.required' => 'zvyber linku',
            ]);

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

        if ($this->cislo_linky == "") {
            $this->dispatch('alert-error', message: "vyber_linku");
            return;
        }

        $linka_na_trase = Linka::where('cislo_linky', $this->cislo_linky)->first();
        // dd($this->cislo_linky);
        // After successful validation, create a new vehicle with the validated data

        /** we have to have at least 2 stops to create 'usek'  */
        $zastavka_length = count($this->zastavka);
        if ($zastavka_length <= 1) {
            $this->dispatch('alert-error', message: "trasa musí mať aspoň 2 zastávky");
            return;
        }

        $nova_trasa = Trasa::create([
            'meno_trasy' => $validatedData['meno_trasy'],
            'info_trasy' => $validatedData['info_trasy'],
            'id_linka' => $linka_na_trase->id_linka,
        ]);

        // dd($zastavka_length);
        for ($i = 0; $i <= $zastavka_length-2; $i++) {
            $zaciatok = $this->zastavka[$i];
            $koniec = $this->zastavka[$i+1];
            $dbZastavka_zaciatok = Zastavka::where('meno_zastavky', $zaciatok)->first();
            $dbZastavka_koniec = Zastavka::where('meno_zastavky', $koniec)->first();
            // dd( $dbZastavka_zaciatok->id_zastavka ,$dbZastavka_koniec->id_zastavka);
            Usek::create([
                'id_zastavka_zaciatok' => $dbZastavka_zaciatok->id_zastavka,
                'id_zastavka_koniec' => $dbZastavka_koniec->id_zastavka,
                'dlzka_useku_km' => $this->dlzka[$i],
                'cas_useku_minuty' => $this->cas[$i],
                'id_trasa' => $nova_trasa->id_trasa,
                'poradie_useku' => $i,
            ]);
        }


        // Reset input field properties, display success message and dispatch an event to refresh the users list
        $this->reset(['meno_trasy', 'info_trasy']);
        // $this->dispatch('refresh-list')->to(ManageLinksListRoutes::class);
        $this->dispatch('alert-success', message: "Trasa bola pridana do databázy");
        return redirect()->to('/manageLinks');   // refresh the page

    }
        

        /** add dynamic button fot stops */
        public $inputs;
        public $i;
        public $zastavka;
        public $dlzka;
        public $cas;
        // init in mount
    
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


    public function mount() {
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
        return view('livewire.manage-links-add-routes');
    }
}
