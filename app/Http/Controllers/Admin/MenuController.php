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
        $products = Auth::user()->business->products->sortByDesc('id');

        return view('admin.menu.edit', ['products' => $products]);
    }
}
