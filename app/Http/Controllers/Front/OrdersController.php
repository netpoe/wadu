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
            'order' => $order
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
