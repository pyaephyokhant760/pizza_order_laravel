<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\userList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //ajax
    public function ajaxPage(Request $request) {
        if($request->status == 'des') {
            $data = Product::orderBy('created_at','desc')->get();
        }else {
            $data = Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }

    // cart
    public function cart(Request $request) {
        $data = $this->getdata($request);
        Cart::create($data);
        $respon = [
            'message' => 'Add To Cart Complete',
            'status' =>'Success'
        ];
        return response()->json($respon, 200);
    }

    // order
    public function order(Request $request) {
        $total = 0;
        foreach($request->all() as $item) {
            $data = userList::create($item);
            $total += $data->total;
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);

        return response()->json([
            'message' => 'order complete',
            'status' => 'true'
        ], 200);
    }

    // cartClear
    public function cartClear() {
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // cartCrow
    public function cartCrow(Request $request) {
        Cart::where('user_id',Auth::user()->id)->where('product_id',$request->productId)->delete();
    }

    // viewCount
    public function viewCount(Request $request) {
        $pizza = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];
        Product::where('id',$request->productId)->update($viewCount);
    }






    // getdata
    private function getdata($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
