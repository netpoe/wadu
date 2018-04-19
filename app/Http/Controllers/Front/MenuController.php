<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\{
    Business\BusinessAdapter as Business,
    Order\OrderAdapter as Order,
    Order\OrderStatusAdapter as OrderStatus,
    User\UserAdapter as User
};

class MenuController extends Controller
{
    public function index(
        String $businessSlug,
        User $user,
        Request $request)
    {
        $business = Business::where([
            'slug' => $businessSlug
        ])->firstOrFail();

        // TODO, si no se ha creado ninguna orden para este WhatsApp, hay error
        // TODO, si no hay $user param crear usuario nuevo vacío y orden nueva

        $order = $business->getUserLatestOrder($user, OrderStatus::STARTED);

        $products = $business->products;

        return view('front.menu.index', [
            'products' => $products,
            'business' => $business,
            'order' => $order,
        ]);
    }
}


