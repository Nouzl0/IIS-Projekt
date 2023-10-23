<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login (Request $request) {
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:200']
        ]);
        return 'hello there Controller';

        // $incomingFields['password'] = bcrypt($incomingFields['password']);
        // User::create($incomingFields);

        // https://youtu.be/cDEVWbz2PpQ?t=1355
    }
}
