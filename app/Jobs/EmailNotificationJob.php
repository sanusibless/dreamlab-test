<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\OrdersNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class EmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $order;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::route('mail', $this->user->email)->notify(new OrdersNotification($this->order));
    }
}
