<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

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

Route::get('/', 'App\Http\Controllers\HomeController@index');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function() {
    //Staff Area
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'staff'])->name('dashboard');
    //Availability
    Route::get('/schedule/{month}/{year}', 'App\Http\Controllers\AvailabilityController@index')->name('availability.index');
    Route::get('/availability/create', 'App\Http\Controllers\AvailabilityController@create')->name('availability.create');
    Route::post('/availability/set', 'App\Http\Controllers\AvailabilityController@set');
    Route::post('/availability/check', 'App\Http\Controllers\AvailabilityController@check');
    
    //Clients
    Route::resource('/clients', 'App\Http\Controllers\ClientController');
    //Shifts
    Route::resource('/shifts', 'App\Http\Controllers\ShiftController');
    //Timesheets
    Route::resource('/timesheets', 'App\Http\Controllers\TimesheetController');
    //Document Type
    Route::resource('/documents', 'App\Http\Controllers\DocumentController');
    Route::resource('/types', 'App\Http\Controllers\TypeController');
    //Roles
    Route::resource('/roles', 'App\Http\Controllers\RoleController');
    //Users
    Route::resource('/users', 'App\Http\Controllers\UserController');
    Route::post('/user/date', 'App\Http\Controllers\UserController@viewDate');
    Route::get('/user/{id}/approval', 'App\Http\Controllers\UserController@newUser')->name('users.approval');
    Route::get('/user/{id}/approve', 'App\Http\Controllers\UserController@approveUser')->name('user.approve');
    Route::get('/user/{id}/deny', 'App\Http\Controllers\UserController@denyUser')->name('user.deny');
    Route::get('/user/{id}/text', 'App\Http\Controllers\UserController@sendSMS')->name('user.text');
    Route::get('user/profile', 'App\Http\Controllers\UserController@viewProfile')->name('user.profile');
    


    /* Photo Uplooader */
    Route::resource('/photos', 'App\Http\Controllers\PhotoController');
    Route::post('/photo/upload', 'App\Http\Controllers\PhotoController@upload');
    Route::get('/photo/{id}/get', 'App\Http\Controllers\PhotoController@get');
    /* Settings */
    Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings.index');

    /* Errors */
    /* Route::get('/forbidden') */

    //Verifying Email
    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['auth', 'signed', 'throttle:6,1'])
                    ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['auth', 'throttle:6,1'])
                    ->name('verification.send');
});
