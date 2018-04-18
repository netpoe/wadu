<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Business\BusinessAdapter as Business;

class MenuController extends Controller
{
    public function index(Business $business)
    {
        print_r($business); exit;
        return 'YEP';
    }
}
