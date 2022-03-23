<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Timesheet;

use App\Notifications\SendTimesheetReceipt;

class SendTimesheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $timesheet;
    
    public function __construct(Timesheet $timesheet)
    {
        $this->timesheet = $timesheet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Send the Email
        \Notification::route('mail', $timesheet->user->email)->notifyNow(new SendTimesheetReceipt($timesheet));

        //Send Notification that the email has been received

        
    }
}
