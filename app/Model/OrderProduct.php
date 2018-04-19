<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\{
    Product\ProductAdapter as Product
};

class OrderProduct extends Model
{
    protected $table = 'order_product';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'amount'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
