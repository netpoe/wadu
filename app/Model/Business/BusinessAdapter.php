<?php

namespace App\Model\Business;

use App\Model\{
    Business,
    Order\OrderAdapter as Order,
    Order\OrderStatusAdapter as OrderStatus,
    User\UserAdapter as User
};

class BusinessAdapter extends Business
{
    public function getUserLatestOrder(User $user, Int $statusId)
    {
        $order = Order::where([
            'business_id' => $this->id,
            'status_id' => $statusId,
            'user_id' => $user->id,
        ])->get()->sortByDesc('created_at')->first();

        return $order;
    }

    public function getOrder(Order $order){
        return $this->orders()->where([
            'id' => $order->id
        ])->get();
    }

    public function getOrders()
    {
        $orders = $this
                    ->orders()
                    // ->whereNotNull('payment_status_id')
                    // ->where('payment_type_id', OrderPaymentType::CASH)
                    ->with(Order::ORDERS_WITH)
                    ->latest()
                    ->skip(0)->take(10)
                    ->get();

        return $orders;
    }
}
