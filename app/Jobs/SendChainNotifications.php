<?php

namespace App\Jobs;

use App\Models\Email;
use App\Notifications\SubscribedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendChainNotifications implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private Email $email;
    private int $index;

    /**
     * Create a new job instance.
     *
     * @param Email $email
     * @param int $index
     */
    public function __construct(Email $email, int $index)
    {
        $this->email = $email;
        $this->index = $index;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->email, new SubscribedNotification(true, $this->index));
    }
}
