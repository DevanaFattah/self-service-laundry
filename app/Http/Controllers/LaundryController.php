<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaundryController extends Controller
{
    public function index () {
        return view("laundry.index");
    }

    public function order() {
        return view("laundry.order");
    }
}
