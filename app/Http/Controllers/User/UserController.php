<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home(){
      $product = Product::get();
      $category = Category::get();
      $cart = Cart::where('user_id', Auth::user()->id)->get();
      //dd(count($cart));
        return view('user.main.home',compact('product','category','cart'));
    }

    public function filter($id){
       $product = Product::where('category_id',$id)->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
          return view('user.main.home',compact('product','category','cart'));
    }

    //seeing product detail through home page
    public function menuDetail($id){
        $menu = Product::where('product_id', $id)->first();
        $menulist = Product::get();
        return view('user.main.detail', compact('menu','menulist'));
    }
    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as menu_name', 'products.price as menu_price', 'products.image as menu_image')
                    ->leftJoin('products','products.product_id','carts.product_id')
                    ->where('user_id', Auth::user()->id)->get();
        //dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $item)
        $totalPrice += $item->menu_price*$item->quantity;

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //order history
    public function orderHistory(){
        $history = Order::where('user_id', Auth::user()->id)->get();
        //dd(Count($history));
        return view('user.main.orderHistory', compact('history'));
    }

    public function change(){
        return view('user.password.change');
    }

    //updating password of user
    public function update(Request $request,$id){
       //dd($request->all(),$id);
        $this->getValidateData($request);
       $oldpassword = User::select('password')->where('id',$id)->first()->toArray(); //your password won't be showed unless you unhide it in model.
       $oldpassword = $oldpassword['password'];
       if(Hash::check($request->oldPassword, $oldpassword)){
        $newpassword = ['password' => Hash::make($request->newPassword)];  // hashed value must be array format , if not, it return error
        // $newpassword=Hash::make('87654321');
        //  dd($newpassword);
         User::where('id',$id)->update($newpassword);
          return back()->with(['successPassword' => 'Password has been changed']);
       }
        return back()->with(['failPassword' => 'not success']);

    }

    public function detail(){
        return view('user.password.userDetail');
    }

    public function userUpdate(Request $request, $id){
        $this->getValidateDetail($request, $id);
        $data = $this->getRequestData($request);

        if($request->hasFile('detailFile')){

            //delete ole file
            $oldfile = User::select('image')->where('id',$id)->first();
            $oldfile = $oldfile['image'];
            if($oldfile != null){
                Storage::delete('public/'.$oldfile);
            }


            //uploading new file
            $newfile = uniqid().'_'.$request->file('detailFile')->getClientOriginalName();
            $request->file('detailFile')->storeAs('public',$newfile);
            $data['image'] = $newfile;
        }
        User::where('id',$id)->update($data);
        return back()->with(['successUpdate' => 'Your information has been updated!']);
    }


    //user list from admin panel
    public function userList(){
        $userList = User::where('role','user')->paginate(10);
        return view('admin.user.userList',compact('userList'));
    }
    public function changeRole(Request $request){
        logger($request->all());
        User::where('id',$request->userId)->update([
            'role' => $request->role
        ]);
    }

    //user list delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back();
    }

    //user contact
    public function contact(){
        return view('user.main.userContact');
    }

    //user contact insert
    public function contactInsert(Request $request){
        $this->getContactValidate($request);
        $contactdata = $this->getContactData($request);
        Contact::create($contactdata);
        return redirect()->route('user#contact')->with(['SentSuccess' => 'Your message has been sent!']);
    }

    // request of contact inseert
    private function getContactData($request){
        return[
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'message' => $request->message,
            'created_at' =>Carbon::now()
        ];
    }
    //validation of contact insert
    private function getContactValidate($request){
        Validator::make($request->all(),[
            // 'name' => 'required',
            // 'email' => 'required',
            'message' => 'required'
        ])->validate();
    }

    //contact page from admin panel
    function contactAdmin(){
        $contact = Contact::get();
        return view('admin.user.contact', compact('contact'));
    }

     //calling this for update
     private function getRequestData($request){
        return [
            'name' => $request -> detailName,
            'email' => $request -> detailEmail,
            'gender' => $request -> detailGender,
            'address' => $request -> detailAddress,
            'phone' => $request -> detailPhone
        ];
    }

    private function getValidateDetail($request, $id = null){
        Validator::make($request->all(),[
            'detailName' => 'required',
            'detailEmail' => 'required|unique:users,email,' .$id,
            'detailGender' => 'required',
            'detailAddress' => 'required',
            'detailPhone' => 'required',
            'detailFile' => 'mimes:jpg,jpeg,png,webp|file'
        ])->validate();
    }

    private function getValidateData($request){
        Validator::make($request->all(),[
                'oldPassword' => 'required|min:6',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword'
        ]

    ,[])->validate();
    }
}
