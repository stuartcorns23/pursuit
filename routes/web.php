<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    //Staff Area
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'staff'])->name('dashboard');
    //Availability
    Route::get('/schedule/{month}/{year}', 'App\Http\Controllers\AvailabilityController@index')->name('availability.index');
    Route::post('/availability/set', 'App\Http\Controllers\AvailabilityController@set');
    //Clients
    Route::resource('/clients', 'App\Http\Controllers\ClientController');
    //Shifts
    Route::resource('/shifts', 'App\Http\Controllers\ShiftController');
    //Users
    Route::resource('/users', 'App\Http\Controllers\UserController');
    


    /* Photo Uplooader */
    Route::resource('/photos', 'App\Http\Controllers\PhotoController');
    Route::post('/photo/upload', 'App\Http\Controllers\PhotoController@upload');
    Route::get('/photo/{id}/get', 'App\Http\Controllers\PhotoController@get');


    /* Errors */
    /* Route::get('/forbidden') */
});
