<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list
    public function list() {
        $pizza = Product::select('products.*','products.name as product_name','categories.name as category_name')
            ->when(request('search'),function($query) {
                $query->where('name','like','%'.request('search').'%');
            })->leftjoin('categories','products.category_id','categories.id')
            ->orderBy('products.created_at','desc')->paginate(3);
        $pizza->appends(request()->all());
        return view('admin.product.pizza_list',compact('pizza'));
    }

    //createPage
    public function createPage() {
        $category = Category::select('id','name')->get();
        return view('admin.product.create',compact('category'));
    }

    // create
    public function create(Request $request) {
        $this->productValidatorCheck($request,'create');
        $data = $this->requestProductInfo($request);

        // image section
        if ($request->hasFile('productImage')) {
            $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return redirect()->route('list#page');
    }

    // delete
    public function delete($id) {
        Product::where('id',$id)->delete();
        return redirect()->route('list#page')->with(['deleteSuccess' => 'Delete Success']);
    }

    // editProduct
    public function editProduct($id) {
        // $pizza = Product::get();
        // dd($pizza->toArray());
        $pizza = Product::select('products.*','products.name as product_name','categories.name as category_name')
        ->leftjoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    // updateProduct
    public function updateProduct($id) {
        $data = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('data','category'));
    }

    // update
    public function update(Request $request) {
        $data = $this->requestProductInfo($request);
        $this->productValidatorCheck($request,'update');


        if ($request->hasFile('productImage')) {
            $oldImage = Product::where('id',$request->pizzaId)->first();
            $oldImage = $oldImage->image;

            if ($oldImage != null) {
               Storage::delete('public/'.$oldImage);
            }

            $fileName = uniqid() .$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('list#page');
    }



    // requestProductInfo
    private function requestProductInfo($request) {
        return [
            'category_id' => $request ->productCategory,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->productWatingTime
        ];
    }

    // productValidatorCheck
    private function productValidatorCheck($request,$action) {
        $validate = [
            'productName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'productCategory' => 'required',
            'productDescription' => 'required|min:10',
            'productPrice' => 'required',
            'productWatingTime' => 'required',
        ];
        $validate['productImage'] = $action == 'create' ?   'required' : '';
        Validator::make($request->all(),$validate)->validate();
    }

}
