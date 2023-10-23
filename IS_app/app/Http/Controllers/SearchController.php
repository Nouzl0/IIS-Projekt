<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search (Request $request) {
        $incomingFields = $request->validate([
            'zastavka' => ['required', 'min:2', 'max:200'],
            'datum' => 'required',
            'cas' => 'required'
        ]);
        return 'choď peši!';
    }
}
