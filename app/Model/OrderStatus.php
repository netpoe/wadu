<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    const STARTED = 1;
    const PENDING = 2;
    const PAID = 3;
    const REVIEWED = 4;
    const RETURNED = 5;
}
