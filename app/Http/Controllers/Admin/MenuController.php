<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menu.index');
    }

    public function edit()
    {
        $business = Auth::user()->business;

        $products = $business->products->sortByDesc('id');

        $productCategories = $business->productCategories->sortBy(function($category){
            return $category->value;
        });

        return view('admin.menu.edit', [
            'business' => $business,
            'products' => $products,
            'productCategories' => $productCategories
        ]);
    }
}
