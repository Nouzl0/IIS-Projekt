<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Zastavka;
use Illuminate\Support\Facades\DB;


class ManageLinksListOfStops extends Component
{

    /* All property */
    public $stops;

    public $editButton = false;
    public $editValue = '';
    public $id_zastavka, $stop_name, $stop_address;

    /* FUNCTIONS */

    /* userGetAll()
    DESCRIPTION:    - Function which gets all the users from the database and formats them
                    - Returns an array of users
    TODO            - use SESSION to get user id
    */
    private function stopGetAll()
    {
        // Retrieve all data from the DB
        $dbZastavky = Zastavka::all();

        // Initialize an empty array to store users
        $stops = [];

        // Loop through each user and format the data
        foreach ($dbZastavky as $dbZastavka) {
            $stops[] = [
                'meno_zastavky' => $dbZastavka->meno_zastavky,
                'adresa_zastavky' => $dbZastavka->adresa_zastavky,
            ];
        }

        return $stops;
    }

    /* stopSave()
    DESCRIPTION:    - Function which validates and updates a stop in the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManageLinksListOfStops' to refresh the stop's list
    */
    public function stopSave($meno)
    {
        try {
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'stop_name' => 'required|string|unique:zastavka,meno_zastavky,' . $meno . ',meno_zastavky',
                'stop_address' => 'required|string',
            ], [
                'stop_name.required' => 'Názov je povinné',
                'stop_name.unique' => 'Zastávka s takým názvom už existuje',
                'stop_address.required' => 'Adresa je povinné',

            ]);

            // After successful validation, find the stop with the given email and update it's data
            Zastavka::where('meno_zastavky', $meno)->update([
                'meno_zastavky' => $validatedData['stop_name'],
                'adresa_zastavky' => $validatedData['stop_address'],
            ]);

            $this->mount(); // refresh view

            // toggleoff edit, dispatch event amd display success message
            $this->editButton = false;
            // $this->dispatch('refresh-users-list')->to(ManageLinksListOfStops::class);
            $this->dispatch('alert-success', message: "Zástavka bola úspešne aktualizovaná");
            return;

            // Displaying error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Validation error");
        }
    }

    /* stopEdit()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function stopEdit($stop_name)
    {

        if ($this->editButton && $this->editValue === $stop_name) {
            // If the button is already in edit mode for the current stop, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different stop, turn it on
            $this->editButton = true;
            $this->editValue = $stop_name;

            // Fill the input fields with the current stop data
            $spoj = DB::table('zastavka')->where('meno_zastavky', '=', $stop_name)->first();
            $this->stop_name = $spoj->meno_zastavky;
            $this->stop_address = $spoj->adresa_zastavky;
        }
    }

    /* stopDelete()
    DESCRIPTION:    - Deletes a stop from the database
    */
    public function stopDelete($stop_name)
    {
        // delete stop from DB
        try {
            DB::table('zastavka')->where('meno_zastavky', '=', $stop_name)->delete();
            // send a message & refresh list
            // $this->dispatch('refresh-users-list')->to(ManageLinksListOfStops::class);
            $this->dispatch('alert-success', message: "Zastávka bola odstránená z databázy");
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "Zastávka je už v úseku, najprv vymaž úsek");
        }

        $this->mount();
    }


    /* LIVEWIRE */

    public function mount()
    {
        // Set the $stop property with the formatted stop array
        $this->stops = $this->stopGetAll();
    }



    public function render()
    {
        return view('livewire.manage-links-list-of-stops');
    }
}
