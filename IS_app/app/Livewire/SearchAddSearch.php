<?php

namespace App\Livewire;

use Livewire\Component;

class SearchAddSearch extends Component
{
    /* ATRIBUTES */

    /* Input field properties */
    public $busStop;      
    public $date;
    public $time;


    /* FUNCTIONS */

    /* searchAdd()
    DESCRIPTION:    - Function which searches for routes with given input data and then
                      displays the results on the search page
                    - Uses 'Input field' for getting input data

    TODO:           - Finish the function, (searching routes) & (sending the searched results to search-list-departures component)
    */
    public function searchAdd()
    {
        try { 
            // Validate input fields with custom error messages
            $validatedData = $this->validate([
                'busStop' => 'required',
                'date' => 'required',
                'time' => 'required',
            ], [
                'busStop.required' => 'Zadajte zastávku',
                'date.required' => 'Zadajte dátum',
                'time.required' => 'Zadajte čas',
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
            
        /* TODO - After successful validation, search and create results of the search
                which will be displayed on search page, code bellow is just for testing
        */
        $departures = [
            0 => ['line' => '52', 'route' => 'Královo Pole, nádraží', 'time' => '15:53', 'date' => '18.11.2023'],
            1 => ['line' => '48', 'route' => 'Královo Pole, nádraží', 'time' => '16:53', 'date' => '18.11.2023'],
            2 => ['line' => '52', 'route' => 'Královo Pole, nádraží', 'time' => '17:53', 'date' => '18.11.2023'],
        ];

        // Send the searched results to session and refresh the list with success message    
        $this->reset(['busStop', 'date', 'time']);
        session(['departuresResults' => $departures]);
        $this->dispatch('refresh-departures')->to(SearchListDepartures::class);
        $this->dispatch('alert-success', message: "Vyhľadávanie prebehlo úspešne");
    }


    /* LIVEWIRE */

    /* - Used for rendering the component in the browser */
    public function render()
    {
        return view('livewire.search-add-search');
    }
}
