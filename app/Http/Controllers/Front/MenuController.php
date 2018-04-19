<?php

namespace App\Http\Controllers\Front;

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
        User $user,
        Request $request,
        Product $product
    )
    {
        $business = Business::where([
            'slug' => $businessSlug
        ])->firstOrFail();

        // TODO, si no se ha creado ninguna orden para este WhatsApp, hay error
        // TODO, si no hay $user param crear usuario nuevo vacío y orden nueva

        $order = $business->getUserLatestOrder($user, OrderStatus::STARTED);

        $products = $business->products;

        $productsByCategory = $product->byCategory($products)->sortKeys();

        return view('front.menu.index', [
            'productsByCategory' => $productsByCategory,
            'business' => $business,
            'order' => $order,
        ]);
    }
}


