<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\SendAvailableUsers;
use App\Models\User;

class NotifyAvailableOperatives implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin = App\Models\User::find(1);
        \Notification::route('mail', 'stuart.corns@tandonta.com')->notifyNow(new SendAvailableUsers($admin));
        /* $admin = Users::where('admin', '=', 1)->get();
        //Send the Email
        foreach($admins as $admin){
            \Notification::route('mail', $admin->email)->notifyNow(new SendAvailableUsers($admin));
        } */

    }
}
