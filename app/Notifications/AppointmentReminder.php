<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminder extends Notification
{
    use Queueable;

    protected $title;
    protected $message;

    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->title)
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line($this->message)
                    ->action('View Your Appointment', url('/'))
                    ->line('Thank you for choosing our car wash services!')
                    ->salutation('Best regards, The Car Wash Team');
    }
}
