<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\{
    Product\ProductInfoAdapter as ProductInfo,
    Product\ProductPriceAdapter as ProductPrice,
    Product\ProductCategoryAdapter as ProductCategory
};

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'business_id',
        'product_category_id'
    ];

    public function info()
    {
        return $this->hasOne(ProductInfo::class, 'product_id', 'id');
    }

    public function price()
    {
        return $this->hasOne(ProductPrice::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');
    }
}
