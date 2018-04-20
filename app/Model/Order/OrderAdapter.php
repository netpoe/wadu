<?php

namespace App\Model\Order;

use App\Model\{
    Order,
    Order\OrderStatusAdapter as OrderStatus,
    Product\ProductAdapter as Product
};

class OrderAdapter extends Order
{
    public function product(Product $product)
    {
        if ($this->products->isEmpty()) {
            return null;
        }

        return $this->products->where('product_id', $product->id)->first();
    }

    public function inStatus(Int $statusId)
    {
        return $this->status->id === $statusId;
    }
}
