<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Timesheet;

class SendTimesheetReceipt extends Notification
{
    use Queueable;

    protected $timesheet;

    public function __construct(Timesheet $timesheet)
    {
        $this->timesheet = $timesheet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
//sends a mail to the safeguarding team from observers on create method
        return (new MailMessage)
            ->subject('You have submitted your Timesheet')
            ->view('mail.timesheet-receipt', ['timesheet' => $this->timesheet])
            ->attach($this->timesheet->getFirstMedia('timesheets')->getPath(), [
                'mime' => 'application/pdf',
            ])
            ->attach($this->timesheet->getFirstMedia('expenses')->getPath(), [
                'mime' => 'application/pdf',
            ]);
    }
}
