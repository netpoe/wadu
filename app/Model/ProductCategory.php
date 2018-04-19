<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    public $timestamps = false;

    protected $fillable = [
        'value',
        'business_id'
    ];
}
