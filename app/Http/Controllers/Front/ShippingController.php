<?php

namespace App\Http\Controllers\Front;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Form\Front\OrderShippingForm;

use App\Model\{
    Order\OrderAdapter as Order
};

class ShippingController extends Controller
{
    public function store(Order $order, Request $request)
    {
        $form = new OrderShippingForm($order);

        $form->setFields();

        $validator = Validator::make(
            $request->all(),
            $form->getValidationRules(),
            $form->getValidationMessages());

        if ($validator->fails()) {
            return redirect('front.orders.shipping')
                    ->withErrors($validator)
                    ->withInput();
        }

        $form->save();

        return redirect()->route('front.orders.checkout', ['order' => $order]);
    }
}
