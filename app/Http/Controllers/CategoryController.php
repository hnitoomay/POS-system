<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(){
        $category = Category::when(request('key'), function($query){
            $query->where('name','like','%'.request('key').'%');
        })-> orderBy('category_id', 'desc')->paginate(5);
        //dd($category);
        return view('admin.category.list', compact('category'));
    }

    //category add page
    public function create(){
        return view('admin.category.create');
    }

    //category create
    public function postcreate(Request $request){
        //dd($request->all());
        $this->getValidateData($request);
        $data = $this->getRequestData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['insertSuccess'=>' Category Created!']);
    }

    public function delete($id){
        Category::where('category_id', $id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess'=>' Category Deleted!']);
    }

    public function edit($id){
        //dd($id);
        $categoryshow = Category::where('category_id',$id)->first();
        return view('admin.category.edit', compact('categoryshow'));
    }

    public function update( Request $request, $id){
        $this->getValidateData($request, $id);
        $data = $this->getRequestData($request);
        Category::where('category_id',$id)->update($data);
        return redirect()->route('category#list');
    }

    private function getRequestData($request){
    return[
        'name' => $request->categoryName
        ];
    }

    private function getValidateData($request, $id= 'null'){
        Validator::make($request->all(),[
            'categoryName'=> 'required', Rule::unique('categories','name')->ignore($id.'category_id')
        ])->validate();
    }
}
