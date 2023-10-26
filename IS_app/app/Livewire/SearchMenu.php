<?php

namespace App\Livewire;

use Livewire\Component;

class SearchMenu extends Component
{
    public function render()
    {
        return view('livewire.search-menu');
    }

    public function search()
    {
        // backend code will be implemented later, right now rederict
        return redirect()->route('search');
    }
}