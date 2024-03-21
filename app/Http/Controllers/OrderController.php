<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\userList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //oderPage
    public function oderPage() {
        $order = Order::select('orders.*','users.name as user_name','users.email as user_email')
                ->leftjoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->paginate(5);
        return view('admin.order.list',compact('order'));
    }

    // status
    public function status(Request $request) {
        // $request->status = $request->status == null ? "" : $request->status;

        $order = Order::select('orders.*','users.name as user_name','users.email as user_email')
                ->leftjoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');
                if ($request->orderStatus == 'all') {
                    $order = $order->get();
                }else{
                    $order = $order->where('orders.status',$request->orderStatus)->get();
                }
                return view('admin.order.list',compact('order'));
    }

    // changeStatus
    public function changeStatus(Request $request) {
        Order::where('id',$request->orderId)->update([
            'status' => $request->status,
        ]);
        $order = Order::select('orders.*','users.name as user_name','users.email as user_email')
                ->leftjoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->paginate(5);
        return response()->json($order, 200);
    }

    // listInfo
    public function listInfo($Code) {
        $order = Order::where('order_code',$Code)->get();
        $userList = userList::select('user_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                            ->leftjoin('users','users.id','user_lists.user_id')
                            ->leftjoin('products','products.id','user_lists.product_id')
                            ->where('order_code',$Code)->get();
        // dd($userList->toArray());
        return view('admin.order.orderList',compact('userList','order'));
    }
}
