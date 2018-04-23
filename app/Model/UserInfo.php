<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
    ];
}
