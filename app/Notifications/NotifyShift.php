<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Shift;

class NotifyShift extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Shift $shift)
    {
        $this->user = $user;
        $this->shift = $shift;
    }

    public function via($notifiable)
    {
        return [SnsChannel::class];
    }

    public function toSns($notifiable)
    {        
        // OR return a SnsMessage passing the arguments via `create()` or `__construct()`:
        return SnsMessage::create([
            'body' => "Hi {$user->fullname()}, you have a shift tonight at {$shift->client->name}. Starting at {$shift->start_time}. If there any problems please let us know as soon as possible. ",
            'transactional' => true,
            'sender' => 'Pursuit-TMR',
        ]); 
    }
}
