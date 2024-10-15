<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list(){
        $products = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function($query){
            $query->where('products.name','like','%'.request('key').'%');
            })->leftJoin('categories','products.category_id','categories.category_id')
            ->orderBy('products.product_id','desc')->paginate(5);
            //dd($products->toArray());
        return view('admin.product.productlist',compact('products'));
    }

    public function create(){
        $category = Category::select('category_id','name')->get();
        //dd($category->toArray());
        return view('admin.product.productcreate', compact('category'));

    }

    public function insert(Request $request){
         $this->getValidateData($request);
        $data = $this->getRequestData($request);
        if($request -> hasFile('image')){

            $newfile = uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$newfile);
            $data['image']=$newfile;
        }
        Product::create($data);
       //return view('admin.product.productlist');
       return redirect()->route('product#list');
    }

    public function delete($id){
        Product::where('product_id', $id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Deleted Successfully']);
    }

    //see more
    public function edit($id){
        $productshow = Product::select('products.*', 'categories.name as category_name')
                                ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
                                ->where('product_id',$id)->first();
       //dd($productshow->toArray());
        return view('admin.product.productedit', compact('productshow'));
    }

    public function updatePage($id){
        $productcarry = Product::where('product_id',$id)->first();
        $category = Category::select('category_id','name')->get();
        return view('admin.product.productupdate', compact('productcarry','category'));
    }

    public function update(Request $request, $id){

        $this->getValidateData($request, $id);

        $data = $this->getRequestData($request);

        if($request -> hasFile('image')){

            $oldfile = Product::select('image')->where('product_id',$id)->first();
            $oldfile = $oldfile->image;
            Storage::delete('public/'.$oldfile);

            $newfile = $request->file('image') -> getClientOriginalName();
            $request->file('image')->storeAs('public',$newfile);
            $data['image'] = $newfile;
        }

        Product::where('product_id',$id)->update($data);
        return redirect()->route('product#edit',$id);
    }

    private function getRequestData($request){
       return [
        'name' => $request -> name,
        'category_id' => $request->category,
        'description' => $request->description,
        'price' => $request->price
       ];
    }
    private function getValidateData($request, $id = null){
        Validator::make($request->all(),[
            'name' => 'required',Rule::unique('products','name')->ignore($id),
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp|file'
        ])->validate();
    }


}
