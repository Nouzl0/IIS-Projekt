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

/*  Main routes  */
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/search', function () {
    return view('search');
})->name('search');

/* User specific routes */
Route::get('/assignedPlan', function () {
    return view('assignedPlan');
})->name('assignedPlan');

Route::get('/assignVehicles', function () {
    return view('assignVehicles');
})->name('assignVehicles');

Route::get('/manageLinks', function () {
    return view('manageLinks');
})->name('manageLinks');

Route::get('/manageUsers', function () {
    return view('manageUsers');
})->name('manageUsers');

Route::get('/manageVehicles', function () {
    return view('manageVehicles');
})->name('manageVehicles');

Route::get('/recordMaintenance', function () {
    return view('recordMaintenance');
})->name('recordMaintenance');

Route::get('/reportIssue', function () {
    return view('reportIssue');
})->name('reportIssue');