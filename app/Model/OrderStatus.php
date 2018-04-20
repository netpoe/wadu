<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';

    public $timestamps = false;

    const STARTED = 1;
    const PENDING_CASH = 2;
    const PENDING_CARD = 3;
    const PAID_CASH = 4;
    const PAID_CARD = 5;
    const DELIVERED = 6;
    const REVIEWED = 7;
    const RETURNED = 8;

    const DATA = [
        self::STARTED => [
            'id' => self::STARTED,
            'value' => 'started',
            'description' => 'Started',
        ],
        self::PENDING_CASH => [
            'id' => self::PENDING_CASH,
            'value' => 'pending_cash',
            'description' => 'Pending',
        ],
        self::PENDING_CARD => [
            'id' => self::PENDING_CARD,
            'value' => 'pending_card',
            'description' => 'Pending',
        ],
        self::PAID_CASH => [
            'id' => self::PAID_CASH,
            'value' => 'paid_cash',
            'description' => 'Paid with cash',
        ],
        self::PAID_CARD => [
            'id' => self::PAID_CARD,
            'value' => 'paid_card',
            'description' => 'Paid with card',
        ],
        self::DELIVERED => [
            'id' => self::DELIVERED,
            'value' => 'delivered',
            'description' => 'Delivered',
        ],
        self::REVIEWED => [
            'id' => self::REVIEWED,
            'value' => 'reviewed',
            'description' => 'Reviewed',
        ],
        self::RETURNED => [
            'id' => self::RETURNED,
            'value' => 'returned',
            'description' => 'Returned',
        ],
    ];
}
