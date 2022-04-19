<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Notifications\AlertOperativesTimesheets as Alert;
use App\Models\User;
use App\Models\Timesheet;

class AlertOperativesTimesheet implements ShouldQueue
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
        $users = User::all();
        $now = \Carbon\Carbon::now();
        $startWeek = \Carbon\Carbon::now()->addWeek()->startOfWeek();
        $endWeek = \Carbon\Carbon::now()->addWeek()->endOfWeek();
        foreach($users as $user){
            if(!$timesheet = Timesheet::where('user_id', '=', $user->id)->where('week_start', '=', $startWeek)->get()){
                $user->notify(new Alert());
            }
        }
    }
}
