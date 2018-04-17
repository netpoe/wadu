<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form\Admin\NewOrderForm;

class OrdersController extends Controller
{
    public function new(NewOrderForm $form) {

        $form->setFields();

        return view('admin.orders.new', [
            'form' => $form,
        ]);
    }

    public function create(NewOrderForm $form, Request $request)
    {
        $form->setFields();

        $validator = Validator::make(
            $request->all(),
            $form->getValidationRules(),
            $form->getValidationMessages());

        if ($validator->fails()) {
            return redirect('admin.orders.new')
                    ->withErrors($validator)
                    ->withInput();
        }

        $form->save();

        if ($form->hasError()) {
            return redirect()->back()->with('error', $form->getErrorMessage());
        }

        return redirect()->route('home');
    }
}
