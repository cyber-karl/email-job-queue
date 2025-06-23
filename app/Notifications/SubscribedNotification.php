<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscribedNotification extends Notification
{
    use Queueable;

    private bool $sendChain;
    private int  $index;

    /**
     * Create a new notification instance.
     */
    public function __construct(bool $sendChain = false, int $index = 1)
    {
        $this->sendChain = $sendChain;
        $this->index = $index;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->line('Thank you for subscribing,')
            ->line('We will share more with you soon!');

        if ($this->sendChain) {
            $mail->line("This is number $this->index in the chain.");
        }

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
