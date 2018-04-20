<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\{
    User\UserAdapter as User,
    User\UserAddressAdapter as UserAddress,
    Business\BusinessAdapter as Business,
    Order\OrderProductAdapter as OrderProduct,
    Order\OrderStatusAdapter as OrderStatus,
    Order\OrderPaymentTypeAdapter as OrderPaymentType,
    Product\ProductAdapter as Product
};

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'business_id',
        'user_id',
        'status_id',
        'product_id',
        'amount'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'id', 'address_id');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status_id');
    }

    public function paymentType()
    {
        return $this->hasOne(OrderPaymentType::class, 'id', 'payment_type_id');
    }
}
