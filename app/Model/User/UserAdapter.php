<?php

namespace App\Model\User;

use App\User;
use App\Model\Business\BusinessAdapter as Business;

class UserAdapter extends User
{
    public static function boot()
    {
        parent::boot();

        self::created(function($user){
            $business = Business::create([
                'name' => request()->business_name,
                'slug' => request()->business_name,
                'user_id' => $user->id,
            ]);

            $user->business_id = $business->id;
            $user->save();
        });
    }
}
