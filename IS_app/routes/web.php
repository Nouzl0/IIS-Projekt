<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*  User (uživatel) routes  */
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/search', function () {
    return view('search');
})->name('search');

/* Driver (Vodič) */
Route::get('/assignedPlan', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'vodič') { 
        return view('assignedPlan'); 
    } 
    else { 
        return view('login'); 
    }
})->name('assignedPlan');

Route::get('/reportIssue', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'vodič') { 
        return view('reportIssue'); 
    } 
    else { 
        return view('login'); 
    }
})->name('reportIssue');

/* Dispatcher (Dispečer) */
Route::get('/assignVehicles', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'dispečer') { 
        return view('assignVehicles'); 
    } 
    else { 
        return view('login'); 
    }
})->name('assignVehicles');

/* Technician (Technik) */
Route::get('/recordMaintenance', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'technik') { 
        return view('recordMaintenance'); 
    } 
    else { 
        return view('login'); 
    }
})->name('recordMaintenance');

/* Manager (správca) */
Route::get('/manageVehicles', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'správca') { 
        return view('manageVehicles'); 
    } 
    else { 
        return view('login'); 
    }
})->name('manageVehicles');

Route::get('/organizeMaintenance', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'správca') { 
        return view('organizeMaintenance'); 
    } 
    else { 
        return view('login'); 
    }
})->name('organizeMaintenance');

Route::get('/scheduleRoutes', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'správca') { 
        return view('scheduleRoutes'); 
    } 
    else { 
        return view('login'); 
    }
})->name('scheduleRoutes');

Route::get('/manageLinks', function () {
    if (session('userRole') === 'administrátor' || session('userRole') === 'správca') { 
        return view('manageLinks'); 
    } 
    else { 
        return view('login'); 
    }
})->name('manageLinks');

/* Administrator (Administrátor) */
Route::get('/manageUsers', function () {
    if (session('userRole') === 'administrátor') { 
        return view('manageUsers'); 
    } 
    else { 
        return view('login'); 
    }
})->name('manageUsers');