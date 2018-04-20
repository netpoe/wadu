<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentType extends Model
{
    protected $table = 'order_payment_type';

    public $timestamps = false;

    const CASH = 1;
    const CARD = 2;

    const DATA = [
        self::CASH => [
            'id' => self::CASH,
            'value' => 'cash',
            'description' => 'Cash',
        ],
        self::CARD => [
            'id' => self::CARD,
            'value' => 'card',
            'description' => 'Card',
        ],
    ];
}
