<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function productList(){
        $product = Product::get();
        return response()->json($product, 200);
    }

    public function categoryList(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    public function categoryCreate(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //category delete
    public function categoryDelete(Request $request){
       $data = Category::where('category_id', $request->id)->first();
       if(isset($data)){
        Category::where('category_id', $request->id)->delete();
        return response()->json(['status' =>'true','message' => 'success deleted', $data], 200);
       }
    }

    //category show
    public function categoryShow(Request $request){
        $data = Category::where('category_id',$request-> id)->first();
        if(isset($data)){
            return response()->json($data, 200);
        }
        return response()->json(['status' =>'false','message' => 'no data'], 500);
    }

    //category update
    public function categoryUpdate(Request $request){
        $category_id = $request->id;
        $data = Category::where('category_id', $category_id)->first();

        if(isset($data)){
            $updatedata = [
                'name' => $request->name,
                'updated_at' => Carbon::now()
            ];
             Category::where('category_id', $category_id)->update($updatedata);
            return response()->json(['status' =>'true','message' => 'update success', $updatedata], 200);

        }
        return response()->json(['status' =>'false','message' => 'no data'], 500);
    }


    //contact create
    public function contactCreate(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        $response = Contact::create($data);
        return response()->json($response, 200);
    }

    //contact delete
    public function contactDelete($id){
        $data = Contact::where('contact_id', $id)->first();
        if(isset($data)){
            Contact::where('contact_id',$id)->delete();
            return response()->json(['status' =>'true','message' => 'success deleted', $data],200);
        }
        return response()->json(['status' =>'false','message' => 'no data'], 200);
    }
}
