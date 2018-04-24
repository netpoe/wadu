<?php

namespace App\Broadcasting\Admin;

use App\User;
use App\Model\{
    Business\BusinessAdapter as Business,
    Order\OrderAdapter as Order
};

class OrdersIndexChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user, Business $business)
    {
        return $user->business->id === $business->id;
    }
}
