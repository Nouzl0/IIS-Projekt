<?php
namespace App\Livewire;

use App\Models\Uzivatel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class ManageUsersList extends Component
{
    /* ATRIBUTES */

    /* All users property */
    public $users;
    
    /* Edit button properties */
    public $editButton = false;
    public $editValue = '';

    /* Input field properties */
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $role;


    /* FUNCTIONS */

    /* userGetAll()
    DESCRIPTION:    - Function which gets all the users from the database and formats them
                    - Returns an array of users
    */
    private function userGetAll()
    {
        // Retrieve all users from the DB
        $dbUsers = DB::table('uzivatel')->get()->toArray();

        // Initialize an empty array to store users
        $users = [];

        // Loop through each user and format the data
        foreach ($dbUsers as $dbUser) {
            $users[] = [
                'firstName' => $dbUser->meno_uzivatela,
                'lastName' => $dbUser->priezvisko_uzivatela,
                'email' => $dbUser->email_uzivatela,
                'password' => $dbUser->heslo_uzivatela,
                'role' => $dbUser->rola_uzivatela,
            ];
        }

        return $users;
    }

    /* userSave()
    DESCRIPTION:    - Function which validates and updates a user in the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManageUsersList' to refresh the user's list
    */
    public function userSave($userEmail) {
        try {
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|string|email|unique:uzivatel,email_uzivatela,' . $userEmail . ',email_uzivatela',
                'password' => 'required|string|min:6',
                'role' => 'required|in:administrátor,správca,vodič,dispečer,technik',
            ], [
                'firstName.required' => 'Meno je povinné',
                'lastName.required' => 'Priezvisko je povinné',
                'email.required' => 'E-mail adresa je povinná',
                'email.email' => 'E-mail adresa, musí mať validný formát',
                'email.unique' => 'E-mail adresa je už v databáze',
                'password.required' => 'Heslo je povinné',
                'password.min' => 'Heslo musí mať aspoň :min znakov.',
                'role.required' => 'Rola je povinná',
                'role.in' => 'Bola vybratá neplatná rola',
            ]);

            // After successful validation, find the user with the given email and update it's data
            Uzivatel::where('email_uzivatela', $userEmail)->update([
                'meno_uzivatela' => $validatedData['firstName'],
                'priezvisko_uzivatela' => $validatedData['lastName'],
                'email_uzivatela' => $validatedData['email'],
                'heslo_uzivatela' => bcrypt($validatedData['password']),
                'rola_uzivatela' => $validatedData['role'],
            ]);
    
            // toggleoff edit, dispatch event amd display success message
            $this->editButton = false;
            $this->dispatch('refresh-users-list')->to(ManageUsersList::class);
            $this->dispatch('alert-success', message: "Užívateľ bol úspešne aktualizovaný");
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

    /* userEdit()
    DESCRIPTION:    - Function which toggles the edit option for a user (UI)
                    - Uses 'Edit button' properties for displaying the UI and 'Input field' for filling the input fields
    */
    public function userEdit($userEmail)
    {
        if ($this->editButton && $this->editValue === $userEmail) {
            // If the button is already in edit mode for the current user, turn it off
            $this->editButton = false;
            $this->editValue = '';
        } else {
            // If the button is not in edit mode or is in edit mode for a different user, turn it on
            $this->editButton = true;
            $this->editValue = $userEmail;
            
            // Fill the input fields with the current user data
            $user = DB::table('uzivatel')->where('email_uzivatela', '=', $userEmail)->first();
            $this->firstName = $user->meno_uzivatela;
            $this->lastName = $user->priezvisko_uzivatela;
            $this->email = $user->email_uzivatela;
            $this->password = $user->heslo_uzivatela;
            $this->role = $user->rola_uzivatela;
        }
    }

    /* userDelete()
    DESCRIPTION:    - Deletes a user from the database
                    - Dispatches an event to component 'ManageUsersList' to refresh the user's list
    TODO            - !!!!!!!deletes last admim DOESNT WORK!!!!!!!!
    */
    public function userDelete($userEmail) {
        
        // delete user from DB
        DB::table('uzivatel')->where('email_uzivatela', '=', $userEmail)->delete();

        // if the number of admin users is 1, do not delete the admin user
        $adminCount = DB::table('uzivatel')->where('rola_uzivatela', '=', 'admin')->count();
        $userRole = DB::table('uzivatel')->where('email_uzivatela', '=', $userEmail)->value('rola_uzivatela');
        if ($adminCount == 1 && $userRole == 'admin') {
            $this->dispatch('alert-error', message: "Užívatel nemôže byť odstránený, v databáze musí byť aspoň jeden administrátor");
            return;
        }

        // send a message & refresh list
        $this->dispatch('refresh-users-list')->to(ManageUsersList::class);
        $this->dispatch('alert-success', message: "Užívateľ bol odstránený z databázy");
    }


    /* LIVEWIRE */

    /* - Used for mounting the component, with listener to refresh the the list */
    #[On('refresh-users-list')]
    public function mount()
    {
        // Set the $users property with the formatted users array
        $this->users = $this->userGetAll();
    }
    
    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.manage-users-list');
    }
}