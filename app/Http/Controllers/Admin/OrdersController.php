<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form\Admin\NewOrderForm;
use App\Service\WhatsAppService;
use App\Event\Admin\IndexOrdersEvent;

use App\Util\{
    WhatsAppNumberProcessor,
    StringUtil
};

use App\Model\{
    User\UserAdapter as User,
    User\UserContactAdapter as UserContact,
    Order\OrderAdapter as Order,
    Order\OrderStatusAdapter as OrderStatus,
    Order\OrderPaymentStatusAdapter as OrderPaymentStatus,
    Order\OrderPaymentTypeAdapter as OrderPaymentType
};

class OrdersController extends Controller
{
    private function getBusinessOrders()
    {
        $orders = Auth::user()
                    ->business
                    ->orders()
                    // ->whereNotNull('payment_status_id')
                    // ->where('payment_type_id', OrderPaymentType::CASH)
                    ->with(Order::ORDERS_WITH)
                    ->latest()
                    ->skip(0)->take(10)
                    ->get();

        return $orders;
    }

    public function index() {
        $orders = $this->getBusinessOrders();

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function new(NewOrderForm $form) {

        $form->setFields();

        return view('admin.orders.new', [
            'form' => $form,
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order
        ]);
    }

    public function process(Order $order)
    {
        // TODO una orden no puede ser procesada por un usuario que está atendiendo otra orden

        $order->processed_by_user_id = Auth::id();
        $order->save();

        $orders = $this->getBusinessOrders();
        event(new IndexOrdersEvent($orders));

        return redirect()->route('admin.orders.show', [$order]);
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

        $orders = $this->getBusinessOrders();

        event(new IndexOrdersEvent($orders));

        return redirect()->route('admin.orders.greet', [$order]);
    }

    public function greet(
        Order $order,
        WhatsAppService $wa)
    {
        return view('admin.orders.greet', ['greet' => $wa->greet($order)]);
    }
}
