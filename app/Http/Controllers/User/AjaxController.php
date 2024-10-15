<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Console\Migrations\StatusCommand;

class AjaxController extends Controller
{
    public function list(Request $request){

       if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();

       }else{
            $data = Product::orderBy('created_at','desc')->get();

       }
      return response()->json($data);
    }

    //adding data to cart table
    public function insert(Request $request){
        logger($request->all()); //we cannot show with dd because it is returned from javascript// before this, we have to write ajax in user page
        $data = $this->getRequestData($request);   // achieving data that come from ajax object
        //logger($data);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'add to cart complete'
        ];
        return response()->json($response, 200);       //it is called by ajax. response


    }

    //adding data to orderlist table //cart delete and // order create
    public function orderList(Request $request){  //this work when customer click orderBtn
        //logger($request->all());
        $subTotal = 0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
                'order_code' => $item['order_code']
            ]);

            $subTotal += $data->total;
        };
        //logger($subTotal + 3000);

        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $subTotal+ 3000
        ]);
        return response()->json([
            'status' => 'true',
            'message' => 'order completed'
       ], 200);
    }

    //clear cart //cancelBtn
    public function cartClear(){

        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //cart single row clear
    public function rowClear(Request $request){
        Cart::where('user_id', Auth::user()->id)
            ->where('cart_id', $request->cartId)
            ->where('product_id', $request->productId )->delete();
    }

    //view count ajax
    public function viewCount(Request $request){
        //logger($request->all());
        $data = Product::where('product_id', $request->productId)->first();
        logger($data);
        $viewCount = [
            'view_count' => $data->view_count + 1
        ];
        logger($viewCount);
        Product::where('product_id', $request->productId)->update($viewCount);
    }


    //add to cart data are added to cart table field
    private function getRequestData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->count,
        ];

    }
}
