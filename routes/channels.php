<?php

use App\Broadcasting\{
    Admin\OrdersIndexChannel,
    Admin\OrderShowChannel
};

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('orders.{business}', OrdersIndexChannel::class);
Broadcast::channel('order.{order}.business.{business}', OrderShowChannel::class);
