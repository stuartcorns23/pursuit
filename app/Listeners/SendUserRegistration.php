<?php

namespace App\Listeners;

use App\Events\UserRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoggedIn;
use App\Mail\NewUserRegistration;
use App\Mail\NewUserAccount;
use App\Models\User;

class SendUserRegistration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistration  $event
     * @return void
     */
    public function handle(UserRegistration $event)
    {
        foreach(User::whereAdmin(1)->get() as $user){
            Mail::to($user->email)
            ->send(new NewUserAccount($user, $event->user));
        }

        Mail::to($event->user->email)
        ->send(new NewUserRegistration($event->user));
    }
}
