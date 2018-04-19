<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function store(Order $order)
    {
        return redirect()->route('front.orders.checkout');
    }
}
