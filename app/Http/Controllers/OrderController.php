<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function orders()
    {
        $collectionorder = Order::get();
        return view('orders.order')->with(compact('collectionorder'));
    }

    public function orderdetails($ordercode)
    {
        $order = Order::where([['order_code',$ordercode]])->first();
        return view('orders.orderdetails')->with(compact('order'));
    }

    public function invoice()
    {
        return view('orders.invoice');
    }
}
