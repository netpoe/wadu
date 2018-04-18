<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\{
    User\UserAdapter as User,
    Business\BusinessAdapter as Business
};

class Order extends Model
{
    protected $table = 'orders';

    public $incrementing = false;

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

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }
}
