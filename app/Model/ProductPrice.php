<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'product_price';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'value',
        'discount'
    ];
}
