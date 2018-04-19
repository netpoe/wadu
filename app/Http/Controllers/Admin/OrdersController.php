<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form\Admin\NewOrderForm;
use App\Service\WhatsAppService;

use App\Util\{
    WhatsAppNumberProcessor,
    StringUtil
};

use App\Model\{
    User\UserAdapter as User,
    User\UserContactAdapter as UserContact,
    Order\OrderAdapter as Order,
    Order\OrderStatusAdapter as OrderStatus
};

class OrdersController extends Controller
{
    public function new(NewOrderForm $form) {

        $form->setFields();

        return view('admin.orders.new', [
            'form' => $form,
        ]);
    }

    public function create(
        NewOrderForm $form,
        Request $request)
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

        $whatsappNumberProcessor = new WhatsAppNumberProcessor($request->input('whatsapp'));

        $whatsappNumberProcessor
            ->sanitizeNumber()
            ->searchExistingNumbers();

        $field = $form->getField('whatsapp');


        if (!$whatsappNumberProcessor->foundExistingNumbers()) {
            $user = new User;
            $user->save();

            $userContact = new UserContact;
            $userContact->user_id = $user->id;

            $field->setModel($userContact);
            $form->save();

            if ($form->hasError()) {
                return redirect()->back()->with('error', $form->getErrorMessage());
            }
        } else {
            $userContact = $whatsappNumberProcessor->getUserContactModel();
            $user = $userContact->user;
        }

        // TODO, check is customer has existing order

        $order = Order::create([
            'business_id' => Auth::user()->business->id,
            'user_id' => $user->id,
            'status_id' => OrderStatus::STARTED,
        ]);

        return redirect()->route('admin.orders.greet', [$order]);
    }

    public function greet(
        Order $order,
        WhatsAppService $wa)
    {
        return view('admin.orders.greet', ['greet' => $wa->greet($order)]);
    }
}
