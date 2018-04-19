<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Util\StringUtil;

use App\Model\{
    Product\ProductAdapter as Product,
    Product\ProductCategoryAdapter as ProductCategory,
    Business\BusinessOrderAdapter as BusinessOrder
};

class Business extends Model
{
    protected $table = 'business';

    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'business_id', 'id');
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class, 'business_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(BusinessOrder::class, 'business_id', 'id');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = StringUtil::makeSlug($value);
    }
}
