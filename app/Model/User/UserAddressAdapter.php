<?php

namespace App\Model\User;

use App\Model\UserAddress;

class UserAddressAdapter extends UserAddress
{
    public function asString()
    {
        return "{$this->street},  {$this->interior_number}. {$this->city},  {$this->state->name} -  {$this->country->name}";
    }
}
