<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
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
            'body' => "Your Account has been approved! If you have verified your email you can now access your account at https://www.pursuit-tmr.co.uk/schedule/".Carbon::now()->format('m\/Y'),
            'transactional' => true,
            'sender' => 'Pursuit-TMR',
        ]); 

        // OR create the object with or without arguments and then use the fluent API:
        return SnsMessage::create()
            ->body("Your Account has been approved! If you have verified your email you can now access your account at https://www.pursuit-tmr.co.uk/schedule/".Carbon::now()->format('m\/Y'))
            ->promotional()
            ->sender('Pursuit TMR');
    }
}

