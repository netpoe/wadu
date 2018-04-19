<?php

namespace App\Model\Order;

use App\Model\Order;
use App\Model\Product\ProductAdapter as Product;

class OrderAdapter extends Order
{
    public function fromProduct(Product $product)
    {
        return $this->where('product_id', $product->id)->first();
    }
}
