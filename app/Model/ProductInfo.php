<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $table = 'product_info';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'name',
        'description'
    ];
}
