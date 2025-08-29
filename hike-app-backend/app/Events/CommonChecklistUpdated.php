<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommonChecklistUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $commonChecklistId;

    public function __construct(string $commonChecklistId)
    {
        $this->commonChecklistId = $commonChecklistId;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('commonChecklist.'.$this->commonChecklistId),
        ];
    }
}
