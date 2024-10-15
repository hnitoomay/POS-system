<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users', 'orders.user_id','users.id' )
                        ->orderBy('created_at','desc')
                        ->paginate(20);
        return view('admin.order.orderList',compact('order'));
    }

    //order Status by admin
    public function status(Request $request){
       //dd($request->status);
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users', 'orders.user_id','users.id' )
        ->orderBy('created_at','desc');
        if($request->status == null){     //seperating query and append order
            $order = $order->get();
        }else{
            $order = $order ->where('orders.status', $request->status)->get();  //if you choose pending, it will only show pending
        }

        return view('admin.order.orderList',compact('order'));
    }

    //change order status by admin      for ajax
    public function changeStatus(Request $request){
       // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status' => $request->changeStatus
        ]);

        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users', 'orders.user_id','users.id' )

        ->where('orders.status', $request->status)->get();

        return view('admin.order.orderList',compact('order'));
    }

    //order detail
    public function orderDetail($order_code){
       $order = Order::where('order_code',$order_code)->first();
       $data = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.price as unit_price','products.image as product_image')
            ->leftJoin('users','users.id','order_lists.user_id')
            ->leftJoin('products','products.product_id','order_lists.product_id')
            ->where('order_code',$order_code)->get();
       //dd($data[0]->user_name);
        return view('admin.order.orderDetail',compact('data','order'));
    }
}
