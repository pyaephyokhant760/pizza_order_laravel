<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    // list page
    public function list() {
        $categories = Category::when(request('search'),function($query) {
            $query->where('name','like','%'.request('search').'%');
        })->orderBy('id','desc')->paginate(4);
        $categories->appends(request()->all());
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
       Category::where('id',$id)->delete();
       return back()->with(['deleteSuccess' => 'DeleteSuccess']);
    }

    // edit page
    public function edit($id) {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update page
    public function update(Request $request,$id) {
        $this->categoryValidator($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list');
    }


    // uploadCsv
    public function uploadCsv(Request $request) {
        if($request->file('csv')) {
            if ($_FILES["csv"]["size"] > 0) {
                $inputFileName =  $request->file('csv');
                $spreadsheet = IOFactory::load($inputFileName);
                dd($spreadsheet->toArray());
            }
        }
    }


    // categoryValidator
    private function categoryValidator($request) {
        Validator::make($request->all(),[
            'categoryName' => 'required|min:5|unique:categories,id,name',
        ])->validate();
    }
    // requestCategoryData
    private function requestCategoryData($request){
        return[
            'name' => $request->categoryName
        ];
    }

}
