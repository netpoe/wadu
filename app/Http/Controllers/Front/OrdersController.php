<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form\Front\OrderShippingForm;

use App\Model\{
    Product\ProductAdapter as Product,
    Order\OrderAdapter as Order,
    Order\OrderProductAdapter as OrderProduct,
    Order\OrderStatusAdapter as OrderStatus,
    Order\OrderPaymentTypeAdapter as OrderPaymentType,
    Order\OrderPaymentStatusAdapter as OrderPaymentStatus,
    Address\AddressStateAdapter as AddressState
};

class OrdersController extends Controller
{
    public function shipping(Order $order)
    {
        $form = new OrderShippingForm($order);

        $form->setFields();

        $addressStates = new AddressState;

        return view('front.orders.shipping', [
            'order' => $order,
            'form' => $form,
            'addressStates' => $addressStates->asJsonByCountryId(),
        ]);
    }

    public function checkout(Order $order)
    {
        return view('front.orders.checkout', [
            'order' => $order,
            'orderStatus' => new OrderStatus,
            'orderPaymentType' => new OrderPaymentType,
            'orderPaymentStatus' => new OrderPaymentStatus,
        ]);
    }

    public function paymentType(Order $order, Request $request)
    {
        // TODO Check if order has been paid
        // TODO make an state machine for order statuses

        $order->where([
            'id' => $order->id,
        ])->update([
            'payment_type_id' => $request->input('payment_type_id'),
            'payment_status_id' => $request->input('payment_status_id'),
        ]);

        // TODO notify business of a requested order

        return redirect()->route('front.orders.pending', [
            'order' => $order,
        ]);
    }

    public function pending(Order $order)
    {
        return view('front.orders.pending', [
            'order' => $order,
        ]);
    }

    public function add(Order $order, Product $product)
    {
        $where = [
            'order_id' => $order->id,
            'product_id' => $product->id,
        ];

        $orderProduct = OrderProduct::updateOrCreate($where);

        $orderProduct->where($where)->update([
            'amount' => $orderProduct->amount + 1,
        ]);

        return redirect()->route('front.menu.index', [
            'businessSlug' => $order->business->slug,
            'order' => $order->id,
        ]);
    }

    public function subtract(Order $order, Product $product)
    {
        $where = [
            'order_id' => $order->id,
            'product_id' => $product->id,
        ];

        $builder = OrderProduct::where($where);

        $orderProduct = $builder->first();

        $redirectParams = [
            'businessSlug' => $order->business->slug,
            'order' => $order->id,
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
