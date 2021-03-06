<?php

namespace App\Http\Controllers\Front;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\{
    Business\BusinessAdapter as Business,
    Order\OrderAdapter as Order,
    Order\OrderStatusAdapter as OrderStatus,
    User\UserAdapter as User,
    Product\ProductCategoryAdapter as ProductCategory,
    Product\ProductAdapter as Product
};

class MenuController extends Controller
{
    public function index(
        String $businessSlug,
        Order $order,
        Request $request,
        Product $product
    )
    {
        $business = Business::where([
            'slug' => $businessSlug
        ])->firstOrFail();

        // TODO: If order is not from business, redirect to 404
        $orderExists = !$business->getOrder($order)->isEmpty();
        if (!$orderExists) {
            return view('front.orders.new', ['business' => $business->id]);
        }

        if (!$order->inStatus(OrderStatus::STARTED)) {
            // TODO, si no se ha creado ninguna orden para este WhatsApp, crear nueva order y mostrar menu
            return view('front.orders.new', ['business' => $business->id]);
        }

        $products = $business->products;

        $productsByCategory = $product->byCategory($products)->sortKeys();

        return view('front.menu.index', [
            'productsByCategory' => $productsByCategory,
            'business' => $business,
            'order' => $order,
        ]);
    }

    public function preview(
        Request $request,
        Product $product
    )
    {
        $business = Auth::user()->business;

        $products = $business->products;

        $productsByCategory = $product->byCategory($products)->sortKeys();

        return view('front.menu.preview', [
            'productsByCategory' => $productsByCategory,
            'business' => $business,
        ]);
    }
}


