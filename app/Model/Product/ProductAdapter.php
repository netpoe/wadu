<?php

namespace App\Model\Product;

use App\Model\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductAdapter extends Product
{
    public function byCategory(Collection $products)
    {
        return $products->mapToGroups(function ($product, $key) {
            if ($product->category()->get()->isEmpty()) {
                return ['z_'.__('other') => $product];
            }

            return [$product->category->value => $product];
        });
    }
}
