<?php

namespace App\Events;

use App\Models\ShipmentItems;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShipmentItemsCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $items;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ShipmentItems $items)
    {
        $this->items = $items;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
