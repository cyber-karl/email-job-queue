<?php

namespace App\Jobs;

use App\Models\Email;
use App\Notifications\SubscribedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendSubscribedNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public Email $email;

    /**
     * Create a new job instance.
     *
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->email, new SubscribedNotification());
        $this->email->update(['notified_at' => now()]);
    }
}
