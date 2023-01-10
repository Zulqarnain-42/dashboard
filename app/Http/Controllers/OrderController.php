<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        return view('orders.order');
    }

    public function orderdetails()
    {
        return view('orders.orderdetails');
    }

    public function invoice()
    {
        return view('orders.invoice');
    }
}
