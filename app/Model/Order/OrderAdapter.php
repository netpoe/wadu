<?php

namespace App\Model\Order;

use App\Util\NumberUtil;
use App\Model\{
    Order,
    Order\OrderStatusAdapter as OrderStatus,
    Product\ProductAdapter as Product
};

class OrderAdapter extends Order
{
    const ORDERS_WITH = ['user',
                        'user.contact',
                        'processor',
                        'processor.contact',
                        'processor.info',
                        'status',
                        'paymentType',
                        'paymentStatus',
                        'address',
                        'address.country',
                        'address.state',
                        'products.product',
                        'products.product.info'];

    public function product(Product $product)
    {
        if ($this->products->isEmpty()) {
            return null;
        }

        return $this->products->where('product_id', $product->id)->first();
    }

    public function getProductsTotal()
    {
        $total = 0;

        $this->products->each(function($orderProduct, $key) use (&$total) {
            $total += $orderProduct->product->price->value * $orderProduct->amount;
        });

        $total = new NumberUtil($total);

        return $total->toCurrency('Q.');
    }

    public function inStatus(Int $statusId)
    {
        return $this->status->id === $statusId;
    }

    public function hasProducts()
    {
        return !$this->products->isEmpty();
    }

    public function hasAddress()
    {
        return !is_null($this->address);
    }

    public function canBeProcessed()
    {
        $inStatus = in_array($this->status_id, [OrderStatus::STARTED, OrderStatus::PROCESSING]);

        return $inStatus && $this->hasProducts();
    }

    public function canBeShipped()
    {
        $inStatus = in_array($this->status_id, [OrderStatus::PROCESSING, OrderStatus::READY_TO_SHIP]);

        return $inStatus && $this->hasProducts() && $this->hasAddress();
    }

    public function getCanBeShippedAttribute()
    {
        return $this->canBeShipped();
    }

    public function getCanBeProcessedAttribute()
    {
        return $this->canBeProcessed();
    }
}
