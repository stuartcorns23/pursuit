<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\AwsSns\SnsChannel;
use NotificationChannels\AwsSns\SnsMessage;
use Illuminate\Notifications\Notification;

class NewAccount extends Notification
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
            'body' => "Your Account has been approved! you can now access your account at https://www.pursuit-tmr.co.uk",
            'transactional' => true,
            'sender' => 'Pursuit-TMR',
        ]); 

        // OR create the object with or without arguments and then use the fluent API:
        return SnsMessage::create()
            ->body("Your Account was approved! you can now access your account at ")
            ->promotional()
            ->sender('Pursuit TMR');
    }
}
