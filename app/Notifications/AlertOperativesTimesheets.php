<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\AwsSns\SnsChannel;
use NotificationChannels\AwsSns\SnsMessage;
use Illuminate\Notifications\Notification;
use \Carbon\Carbon;

class AlertOperativesTimesheet extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [SnsChannel::class];
    }

    public function toSns($notifiable)
    {        
        // OR return a SnsMessage passing the arguments via `create()` or `__construct()`:
        return SnsMessage::create([
            'body' => "You haven't submitted your Timesheet for last week. Please can you do so at - https://www.pursuit-tmr.co.uk/timesheet/create as soon as possible to prevent any delays with your payment. Thank you ",
            'transactional' => true,
            'sender' => 'Pursuit-TMR',
        ]); 
    }
}
