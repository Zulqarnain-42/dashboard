<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function orders()
    {
        $collectionorder = DB::table('orders as order')
            ->join('users as user','user.id','=','order.user_id')
            ->join('payment_details as pay_detail','pay_detail.order_id','=','order.id')
            ->select('order.order_code',
                'order.created_at',
                'user.firstname',
                'user.lastname',
                'order.total')->groupBy('order.id')->paginate(28);

        return view('orders.order')->with(compact('collectionorder'));
    }

    public function orderdetails($ordercode)
    {
        $order = DB::table('orders as order')
            ->join('users as user','user.id','=','order.user_id')
            ->join('order_products as order_product','order_product.order_id','=','order.id')
            ->join('products as product','product.id','=','order_product.product_id')
            ->join('payment_details as pay_detail','pay_detail.order_id','=','order.id')
            ->select('order.*',
                'user.*',
                'order_product.*',
                'product.*',
                'pay_detail.*')->where('order.order_code',$ordercode)->get();
        dd($order);
        return view('orders.orderdetails')->with(compact('order'));
    }

    public function invoice()
    {
        return view('orders.invoice');
    }
}
