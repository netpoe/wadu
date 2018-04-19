<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessOrder extends Model
{
    protected $table = 'business_orders';

    public $timestamps = false;

    protected $fillable = [
        'business_id',
        'order_id'
    ];
}
