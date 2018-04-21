<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentStatus extends Model
{
    protected $table = 'order_payment_status';

    public $timestamps = false;

    const PENDING = 1;
    const PAID = 2;

    const DATA = [
        self::PENDING => [
            'id' => self::PENDING,
            'value' => 'pending',
            'description' => 'Pending'
        ],
        self::PAID => [
            'id' => self::PAID,
            'value' => 'paid',
            'description' => 'Paid'
        ],
    ];
}
