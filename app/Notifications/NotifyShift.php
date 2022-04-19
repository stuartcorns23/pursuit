<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\AwsSns\SnsChannel;
use NotificationChannels\AwsSns\SnsMessage;
use Illuminate\Notifications\Notification;
use \Carbon\Carbon;

use App\Models\User;
use App\Models\Shift;

class NotifyShift extends Notification
{
    use Queueable;

    public $shift;
    public $user;
    
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
            'body' => "Hi {$this->user->fullname()}, you have a shift tonight at {$this->shift->client->name}. Starting at {$this->shift->start_time}. If there any problems please let us know as soon as possible. ",
            'transactional' => true,
            'sender' => 'Pursuit-TMR',
        ]); 
    }
}
