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
    
    TODO:           - Test the component in the browser
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
                'firstName.required' => 'The first name is required.',
                'lastName.required' => 'The last name is required.',
                'email.required' => 'The email address is required.',
                'email.email' => 'The email address must be a valid email.',
                'email.unique' => 'The email address is already in use.',
                'password.required' => 'The password is required.',
                'password.min' => 'The password must be at least :min characters.',
                'role.required' => 'The role is required.',
                'role.in' => 'Invalid role selected.',
            ]);
    
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
            session()->flash('add-success', 'User added successfully.');
            $this->dispatch('refresh-users-list')->to(ManageUsersList::class);
        
        // If validation fails, exception is caught and then is displayed error messages
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = $e->validator->getMessageBag()->all();
            foreach ($messages as $message) {
                session()->flash('add-error', $message);
            }
        
        // If there is any other exception, display basic error message
        } catch (\Exception $e) {
            session()->flash('add-error', 'User could not be added.');
        }
    }

    /* LIVEWIRE */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.manage-users-add');
    }
}