<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\{
    Product\ProductCategoryAdapter as ProductCategory
};

class ProductCategoriesController extends Controller
{
    public function create(Request $request)
    {
        try {
            ProductCategory::create([
                'value' => $request->input('product_category'),
                'business_id' => Auth::user()->business->id,
            ]);
        } catch (\Exception $e) {

        }

        return redirect()->route('admin.menu.edit');
    }

    public function update(ProductCategory $productCategory, Request $request)
    {
        try {
            $productCategory->update([
                'value' => $request->input('product_category'),
            ]);
        } catch (\Exception $e) {

        }

        return redirect()->route('admin.menu.edit');
    }
}
