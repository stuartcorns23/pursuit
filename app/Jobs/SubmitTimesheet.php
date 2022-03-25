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
use App\Jobs\SendTimesheet;

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
        $file = str_replace(' ', '-', $timesheet->user->fullname());
        $date = \Carbon\Carbon::now()->format('dmyhis');
        //Get the user name format [s-corns-ts-19-may-2022]

        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE,
            ]
            ]);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->getDomPDF()->setHttpContext($contxt);
        $pdf->loadView('timesheets.showPDF', compact('timesheet'));
        $pdf->setPaper('a4', 'portrait');
       
       
        Storage::disk('public')->put('timesheets/'.$file.'-'.$date.'.pdf', $pdf->output());
        $timesheet->addMediaFromUrl(Storage::disk('public')->url('timesheets/'.$file.'-'.$date.'.pdf'))->toMediaCollection('timesheets');

        
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            $pdf->getDomPDF()->setHttpContext($contxt);
            $pdf->loadView('timesheets.expensesPDF', compact('timesheet'));
            $pdf->setPaper('a4', 'portrait');

            Storage::disk('public')->put('expenses/'.$file.'-'.$date.'.pdf', $pdf->output());
            $timesheet->addMediaFromUrl(Storage::disk('public')->url('expenses/'.$file.'-'.$date.'.pdf'))->toMediaCollection('expenses');
        
        
        SendTimesheet::dispatch($this->timesheet)->afterResponse();
    }
}
