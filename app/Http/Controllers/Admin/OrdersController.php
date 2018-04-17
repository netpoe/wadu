<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form\Admin\NewOrderForm;
use App\Util\WhatsAppNumberProcessor;
use App\Model\{
    User\UserAdapter as User,
    User\UserContactAdapter as UserContact
};

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

        $whatsappNumberProcessor = new WhatsAppNumberProcessor($request->input('whatsapp'));

        $whatsappNumberProcessor
            ->sanitizeNumber()
            ->searchExistingNumbers();

        $field = $form->getField('whatsapp');

        if ($whatsappNumberProcessor->foundExistingNumbers()) {
            $field->setModel($whatsappNumberProcessor->getUserContactModel());
        } else {
            $user = new User;
            $userContact = new UserContact;
            $userContact->user_id = $user->id;
            $field->setModel($userContact);
        }

        $form->save();

        if ($form->hasError()) {
            return redirect()->back()->with('error', $form->getErrorMessage());
        }

        return redirect()->route('home');
    }
}
