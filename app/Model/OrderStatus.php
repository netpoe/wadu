<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';

    public $timestamps = false;

    const STARTED = 1;
    const PROCESSING = 2;
    const SHIPPED = 3;
    const DELIVERED = 4;
    const REVIEWED = 5;
    const RETURNED = 6;
    const READY_TO_SHIP = 7;

    const DATA = [
        self::STARTED => [
            'id' => self::STARTED,
            'value' => 'started',
            'description' => 'Started',
        ],
        self::PROCESSING => [
            'id' => self::PROCESSING,
            'value' => 'processing',
            'description' => 'Processing',
        ],
        self::SHIPPED => [
            'id' => self::SHIPPED,
            'value' => 'shipped',
            'description' => 'Shipped',
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
        self::READY_TO_SHIP => [
            'id' => self::READY_TO_SHIP,
            'value' => 'ready_to_ship',
            'description' => 'Ready to ship',
        ]
    ];
}
