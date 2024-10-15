<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeUnit\FunctionUnit;

class AdminController extends Controller
{
       //admin change password
       public function change(){
        return view('admin.account.change');
    }

    //confirm new password
    function passwordChange(Request $request){
       $this->getValidateData($request);
       $dbUserid = Auth::user()->id;
       $user = User::select('password')->where('id',$dbUserid)->first();
       $dbUserPassword = $user->password;

      // $ClidentData = Hash::make('Hnit  May');

       if(Hash::check($request->oldPassword,$dbUserPassword)){
        $newUserPassword = ['password' => Hash::make($request->newPassword)];
         User::where('id',$dbUserid)->update($newUserPassword);
         //Auth::logout();
         return back()->with(['successPassword' => 'Password has been changed...']);
       }
       return back()->with(['failPassword' => "Your password doesn't match with the old one"]);
    }

    public function resetPassword( $newPassword)
    {
        $user= Hash::make($newPassword);
        dd($user);
    }
    //admin account detail
    public function detail(){
        return view('admin.account.detail');
    }

    public function edit(){
        return view('admin.account.detailedit');
    }

    public function update($id, Request $request){
        $this -> getValidateDetail($request);
        $data = $this-> getRequestData($request);
        if($request -> hasFile('detailFile') ){
            $oldfile = User::select('image')->where('id', $id)->first()->toArray();
            $oldfile = $oldfile['image'];
            if($oldfile !== null){
                Storage::delete('public/'.$oldfile);
            }

            //adding new photo
            $newfile = uniqid().'-'.$request->file('detailFile')->getClientOriginalName();
            $request->file('detailFile')->storeAs('public',$newfile);  //storing in the project
            $data['image'] = $newfile; //storing new photo in database by creating an array
        };

        //dd($data);
        User::where('id',$id)->update($data);
        //session()->flash('updateSuccess', 'Your information has been updated.');
        return redirect()->route('admin#detail')->with(['updateSuccess' => 'Your information has been updated.']);
    }

    //admin list
    public function list(){
        $adminlist = User::when(request('key'), function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%');
        })->where('role','admin')->paginate(6);

        //dd($adminlist);
        return view('admin.account.list',compact('adminlist'));
    }

    public function delete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess' => 'Deleted Successfully']);
    }

    public function changeRole($id){
        $account = User::where('id',$id)->first();
        //dd($account->toArray());
        return view('admin.account.changeRole',compact('account'));
    }

    public function roleUpdate(Request $request,$id){
        $role = $this->getRoleData($request);
       // dd($role);
        User::where('id',$id)->update($role);
        return redirect()->route('admin#list');
    }

    private function getRoleData($request){
        return [
            'role' => $request->detailRole
        ];
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

    private function getValidateDetail($request){
        Validator::make($request->all(),[
            'detailName' => 'required',
            'detailEmail' => 'required',
            'detailGender' => 'required',
            'detailAddress' => 'required',
            'detailPhone' => 'required',
            'detailFile' => 'mimes:jpg,jpeg,png,webp'
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
