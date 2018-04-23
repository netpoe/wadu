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
    Order\OrderPaymentStatusAdapter as OrderPaymentStatus,
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

    protected $appends = [
        'process_route',
        'show_route',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function processor()
    {
        return $this->hasOne(User::class, 'id', 'processed_by_user_id');
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

    public function paymentStatus()
    {
        return $this->hasOne(OrderPaymentStatus::class, 'id', 'payment_status_id');
    }


    public function getProcessRouteAttribute()
    {
        return route('admin.orders.process', ['order' => $this->attributes['id']]);
    }

    public function getShowRouteAttribute()
    {
        return route('admin.orders.show', ['order' => $this->attributes['id']]);
    }
}
