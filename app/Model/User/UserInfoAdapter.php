<?php

namespace App\Model\User;

use App\Model\UserInfo;

class UserInfoAdapter extends UserInfo
{
    public function fullName()
    {
        return "$this->first_name $this->last_name";
    }
}
