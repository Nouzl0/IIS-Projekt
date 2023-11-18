<?php

namespace App\Livewire;
use Livewire\Attributes\On;

use Livewire\Component;

class Alert extends Component
{
    /* ATRIBUTES */

    /* message properties*/
    public $success = false;
    public $successMessage = null;
    public $error = false;
    public $errorMessage = null;
    

    /* FUNCTIONS */

    /* alertClear()
    DESCRIPTION:    - Function clear alert HTML
                    - Uses public 'message' properties 
                    - Is listening for 'alert-clear' events

    NOTES:          - Calling example -> $this->dispatch('alert-clear');
    */
    #[On('alert-clear')]
    public function alertClear() {
        $this->success = false;
        $this->error = false;
    }

     /* alertClear()
    DESCRIPTION:    - Displays success message
                    - Uses public 'message' properties 
                    - Is listening for 'alert-sucess' events

    NOTES:          - Calling example -> $this->dispatch('alert-success', message: $messageVar);
    */
    #[On('alert-success')]
    public function alertSuccess($message) {
        
        // set the message
        if ($message == null) {
            $this->successMessage = "[Error] - Success message = null";
        } else {
            unset($this->successMessage);
            $this->successMessage = $message;
        }

        // display the message
        $this->error = false;
        $this->success = true;
    }
    
     /* alertError()
    DESCRIPTION:    - Displays error message
                    - Uses public 'message' properties 
                    - Is listening for 'alert-error' events

    NOTES:          - Calling example -> '$this->dispatch('alert-error', message: $messageVar);'
    */
    #[On('alert-error')]
    public function alertError($message) {

        //set the message
        if ($message == null) {
            $this->errorMessage = "[Error] - Error message = null";
        } else {
            unset($this->errorMessage);
            $this->errorMessage = $message;
        }

        // display the message
        $this->success = false;
        $this->error = true;
    }


    /* LIVEWIRE */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.alert');
    }
}
