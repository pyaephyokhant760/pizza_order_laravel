<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    //home
    public function home() {
        $pizza = Product::orderBy('id','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.user',compact('pizza','category','cart','history'));
    }

    // filterphp
    public function filter($id) {
        $pizza = Product::where('category_id',$id)->orderBy('id','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.user',compact('pizza','category','cart','history'));
    }

    // password
    public function password() {
        return view('user.password.changeUser');
    }

    // passwordChange
    public function passwordChange(Request $request) {
        $this->validatorCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbpassword = $user->password;
        if (Hash::check($request->oldPassword, $dbpassword)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
           Auth::logout();
           return redirect()->route('login#page');
        }
        return back()->with(['notMatch' => 'The Old Password Not Match. Try Again!']);
    }

    // accountchangePage
    public function accountchangePage() {
        return view('user.profile.accountUser');
    }

    // changeAccountPage
    public function changeAccountPage($id,Request $request){
        $this->editvalidatorCheck($request);
       $data = $this->getdata($request);

        // for image
        if ($request->hasfile('image')) {
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete(['punlic/', $dbImage]);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }


       User::where('id',$id)->update($data);
       return redirect()->route('home#page');
    }

    // detail
    public function detail($id) {
        $data = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('data','pizzaList'));
    }

    // cartList
    public function cartList() {
        $data = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price')
                    ->leftJoin('products','products.id','carts.product_id')->where('carts.user_id',Auth::user()->id)->get();
        $totalPrice = 0;
        foreach($data as $d){
            $totalPrice += $d->pizza_price*$d->qty;
        };
        return view('user.main.cart',compact('data','totalPrice'));
    }

    // history
    public function history() {
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.main.history',compact('order'));
    }

     // getdata
     private function getdata($request) {
        return  [
         'name' => $request->name,
         'email' => $request->email,
         'phone' => $request->phone,
         'gender' => $request->gender,
         'address' => $request->address,
         'updated_at' => Carbon::now()
        ];
     }

    // editvalidatorCheck
    private function editvalidatorCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required',
        ])->validate();
    }

    // validatorCheck
    private function validatorCheck($request) {
        Validator::make($request->all(),[
        'oldPassword' => 'required|min:6',
        'newPassword' => 'required|min:6',
        'comfirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
