<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form\Front\OrderShippingForm;

use App\Model\{
    Product\ProductAdapter as Product,
    Order\OrderAdapter as Order,
    Order\OrderStatusAdapter as OrderStatus
};

class OrdersController extends Controller
{
    public function shipping(Order $order)
    {
        $form = new OrderShippingForm($order);

        $form->setFields();

        return view('front.orders.shipping', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    public function add(Order $order, Product $product)
    {
        $where = [
            'id' => $order->id,
            'user_id' => $order->user_id,
            'business_id' => $order->business_id,
            'product_id' => $product->id,
            'status_id' => OrderStatus::STARTED,
        ];

        $orderProduct = Order::updateOrCreate($where);

        $orderProduct->where($where)->update([
            'amount' => $orderProduct->amount + 1,
        ]);

        return redirect()->route('front.menu.index', [
            'businessSlug' => $order->business->slug,
            'user' => $orderProduct->user_id,
        ]);
    }

    public function subtract(Order $order, Product $product)
    {
        $where = [
            'id' => $order->id,
            'user_id' => $order->user_id,
            'business_id' => $order->business_id,
            'product_id' => $product->id,
            'status_id' => OrderStatus::STARTED,
        ];

        $builder = Order::where($where);

        $orderProduct = $builder->first();

        $redirectParams = [
            'businessSlug' => $order->business->slug,
            'user' => $orderProduct->user_id,
        ];

        if ($orderProduct->amount == 1) {
            $builder->delete();

            return redirect()->route('front.menu.index', $redirectParams);
        }

        $builder->update([
            'amount' => $orderProduct->amount - 1
        ]);

        return redirect()->route('front.menu.index', $redirectParams);
    }
}
