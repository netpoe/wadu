<?php

namespace App\Model\Order;

use App\Model\OrderProduct;
use App\Util\NumberUtil;

class OrderProductAdapter extends OrderProduct
{
    public function getPrice()
    {
        $number = new NumberUtil($this->product->price->value * $this->amount);

        return $number->toCurrency('Q.');
    }
}
