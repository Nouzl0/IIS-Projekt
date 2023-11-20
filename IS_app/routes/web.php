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
    return view('assignedPlan');
})->name('assignedPlan');

Route::get('/reportIssue', function () {
    return view('reportIssue');
})->name('reportIssue');

/* Dispatcher (Dispečer) */
Route::get('/assignVehicles', function () {
    return view('assignVehicles');
})->name('assignVehicles');

/* Technician (Technik) */
Route::get('/recordMaintenance', function () {
    return view('recordMaintenance');
})->name('recordMaintenance');

/* Manager (správca) */
Route::get('/manageVehicles', function () {
    return view('manageVehicles');
})->name('manageVehicles');

Route::get('/organizeMaintenance', function () {
    return view('organizeMaintenance');
})->name('organizeMaintenance');

Route::get('/scheduleRoutes', function () {
    return view('scheduleRoutes');
})->name('scheduleRoutes');

Route::get('/manageLinks', function () {
    return view('manageLinks');
})->name('manageLinks');

/* Administrator (Administrátor) */
Route::get('/manageUsers', function () {
    return view('manageUsers');
})->name('manageUsers');