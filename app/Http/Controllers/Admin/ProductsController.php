<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\{
    Product\ProductAdapter as Product,
    Product\ProductInfoAdapter as ProductInfo,
    Product\ProductPriceAdapter as ProductPrice
};

class ProductsController extends Controller
{
    public function create(Request $request)
    {
        $product = Product::create([
            'business_id' => Auth::user()->business->id,
            'product_category_id' => $request->input('product_category_id')
        ]);

        $productInfo = ProductInfo::create([
            'product_id' => $product->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $productPrice = ProductPrice::create([
            'product_id' => $product->id,
            'value' => $request->input('price'),
            'discount' => $request->input('discount'),
        ]);

        return redirect()->route('admin.menu.edit');
    }

    public function update(Product $product, Request $request)
    {
        $product->info->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $product->price->update([
            'value' => $request->input('price'),
            'discount' => $request->input('discount'),
        ]);

        return redirect()->route('admin.menu.edit');
    }
}
