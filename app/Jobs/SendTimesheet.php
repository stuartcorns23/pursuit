<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        

        //Send Notification that the email has been received

        
    }
}
