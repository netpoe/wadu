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

class ShowOrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = Order::with(Order::ORDERS_WITH)->find($order->id);
    }

    public function broadcastAs()
    {
        return 'show.order.event';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $businessId = $this->order->business->id;

        return new PrivateChannel("order.{$this->order->id}.business.$businessId");
    }
}
