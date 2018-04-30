<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form\Front\OrderShippingForm;

use App\Event\{
    Admin\IndexOrdersEvent,
    Admin\ShowOrderEvent
};

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
        // TODO if order is being processed, status 2, it cannot be edited anymore

        $orderProducts = $order->products->sortByDesc(function($orderProduct, $key){
            return $orderProduct->product->product_category_id;
        });

        return view('front.orders.checkout', [
            'order' => $order,
            'orderProducts' => $orderProducts,
            'orderStatus' => new OrderStatus,
            'orderPaymentType' => new OrderPaymentType,
            'orderPaymentStatus' => new OrderPaymentStatus,
        ]);
    }

    public function paymentType(Order $order, Request $request)
    {
        // TODO Check if order has been paid
        // TODO make an state machine for order statuses

        $paymentStatusId = $request->input('payment_status_id');
        $paymentTypeId = $request->input('payment_type_id');

        $isPendingCash = $paymentStatusId == OrderPaymentStatus::PENDING &&
                        $paymentTypeId == OrderPaymentType::CASH;

        $isPaid = $paymentStatusId == OrderPaymentStatus::PAID &&
                    ($paymentTypeId == OrderPaymentType::CARD || $paymentTypeId == OrderPaymentType::CASH);

        $orderCanBeShipped = $isPendingCash || $isPaid;

        if ($orderCanBeShipped && $order->hasAddress() && $order->hasProducts()) {
            $statusId = OrderStatus::READY_TO_SHIP;
        } else {
            $statusId = OrderStatus::STARTED;
        }

        $order->where([
            'id' => $order->id,
        ])->update([
            'status_id' => $statusId,
            'payment_type_id' => $paymentTypeId,
            'payment_status_id' => $paymentStatusId,
        ]);

        try {
            event(new IndexOrdersEvent($order->business->getOrders()));
            event(new ShowOrderEvent($order));
        } catch (\Exception $e) {}

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

        try {
            event(new IndexOrdersEvent($order->business->getOrders()));
            event(new ShowOrderEvent($order));
        } catch (\Exception $e) {}

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
