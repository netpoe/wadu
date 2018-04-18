<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\User\UserAdapter as User;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'business_id',
        'user_id',
        'status_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
