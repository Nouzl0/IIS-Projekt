<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Uzivatel;

class ManageUsersAdd extends Component
{
    /* ATRIBUTES */

    /* Input field properties */
    public $firstName;      
    public $lastName;
    public $email;
    public $password;
    public $role;


    /* FUNCTIONS */

    /* userAdd()
    DESCRIPTION:    - Function which validates and adds a new user to the database
                    - Uses 'Input field' for getting input data
                    - Is dispatching an event to component 'ManageUsersList' to refresh the user's list

    NOTES:          - This function is completed and should be used as template for creating other similiar components
                    - After finishing the project [notes, todo] should be removed
    */
    public function userAdd()
    {
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|string|email|unique:uzivatel,email_uzivatela',
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

        // If validation fails, exception is caught and then is displayed error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                $this->dispatch('alert-error', message: $message);
            }
            return;

        // If there is any other exception, display basic error message
        } catch (\Exception $e) {
            $this->dispatch('alert-error', message: "ERROR - Interná chyba, kontaktujte administrátora o chybe");
            return;
        }
            
        // After successful validation, create a new user with the validated data
        Uzivatel::create([
            'meno_uzivatela' => $validatedData['firstName'],
            'priezvisko_uzivatela' => $validatedData['lastName'],
            'email_uzivatela' => $validatedData['email'],
            'heslo_uzivatela' => bcrypt($validatedData['password']),
            'rola_uzivatela' => $validatedData['role'],
        ]);

        // Reset input field properties, display success message and dispatch an event to refresh the users list
        $this->reset(['firstName', 'lastName', 'email', 'password', 'role']);
        $this->dispatch('refresh-users-list')->to(ManageUsersList::class);
        $email = $validatedData['email'];
        $this->dispatch('alert-success', message: "Užívateľ \"$email\" bol pridaný do databázy");
    }

    /* LIVEWIRE */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.manage-users-add');
    }
}