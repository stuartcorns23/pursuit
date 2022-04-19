<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\AwsSns\SnsChannel;
use NotificationChannels\AwsSns\SnsMessage;
use Illuminate\Notifications\Notification;
use \Carbon\Carbon;

class AlertOperativesAvailability extends Notification
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
            'body' => "You haven't set any availabilty for next week. If you are available please let us know at - https://www.pursuit-tmr.co.uk/schedule/".Carbon::now()->format('m\/Y')." as soon as possible to prevent any delays. Thank you ",
            'transactional' => true,
            'sender' => 'Pursuit-TMR',
        ]); 
    }
}

