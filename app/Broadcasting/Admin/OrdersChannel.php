<?php

namespace App\Broadcasting\Admin;

use Auth;
use App\Model\Business\BusinessAdapter as Business;
use App\User;

class OrdersChannel
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
        return Auth::user()->business->id === $business->id;
    }
}
