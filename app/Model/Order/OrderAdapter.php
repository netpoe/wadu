<?php

namespace App\Model\Order;

use App\Model\{
    Order,
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
}
