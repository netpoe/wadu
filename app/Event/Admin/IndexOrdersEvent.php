<?php

namespace App\Event\Admin;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Model\Order\OrderAdapter as Order;
use Illuminate\Database\Eloquent\Collection;

class IndexOrdersEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $orders;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function broadcastAs()
    {
        return 'index.orders.event';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $businessId = $this->orders->first()->business->id;

        return new PrivateChannel("orders.$businessId");
    }
}
