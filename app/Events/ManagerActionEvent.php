<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ManagerActionEvent implements ShouldBroadcast
{
    use SerializesModels;

    public int $userId;
    public string $message;

    public function __construct(int $userId, string $message)
    {
        $this->userId = $userId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        // channel unik per user
        return new Channel('user.' . $this->userId);
    }
}
