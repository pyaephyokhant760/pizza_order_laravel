<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // list page
    public function list() {
        $categories = Category::orderBy('category_id','desc')->paginate(4);
        return view('admin.category.list',compact('categories'));
    }

    // create page
    public function create() {
        return view('admin.category.create');
    }

    // recreate
    public function recreate(Request $request) {
        $this->categoryValidator($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['categorySuccess' => 'create success']);
    }

    // Delete
    public function delete($id) {
       Category::where('category_id',$id)->delete();
       return back()->with(['deleteSuccess' => 'DeleteSuccess']);
    }





    // categoryValidator
    private function categoryValidator($request) {
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name'
        ])->validate();
    }

    // requestCategoryData
    private function requestCategoryData($request){
        return[
            'name' => $request->categoryName
        ];
    }

}
