<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use PDF;
use Illuminate\Support\Facades\Storage;
use App\Models\Timesheet;

class SubmitTimesheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timesheet;
    public $notify;
    

    public function __construct(Timesheet $timesheet, $notify)
    {
        $this->timesheet = $timesheet;
        $this->notify = $notify;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $timesheet = $this->timesheet;
        //Get the user name format [s-corns-ts-19-may-2022]
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('timesheets.showPDF', compact('timesheet'));
        $pdf->setPaper('a4', 'portrait');
        Storage::put('public/timesheets/timesheet.pdf', $pdf->output());

        $timesheet->addMedia(Storage::url(asset('storage/timesheets/timesheet.pdf')))->toMediaCollection('timesheets');
        //SendTimesheet::dispatch($timesheet)->afterResponse();
    }
}
