<?php
// Project 2 Order list Controller
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        // $orders = Order::latest('orders.created_at')->select('orders.*','users.name','users.email');
        // $orders = $orders->leftjoin('users','users.id','orders.user_id');
        $orders = Order::latest('orders.created_at')
                  ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                  ->leftJoin('customer_addressess', 'customer_addressess.user_id','=','users.id')
                  ->select('orders.*', 'users.name as user_name', 'users.email as user_email');
    
        
        if($request->get('keyword') != ""){
           $orders = $orders->where('users.name','like','%'.$request->keyword.'%');
           $orders = $orders->orWhere('users.email','like','%'.$request->keyword.'%');
           $orders = $orders->orWhere('customer_addressess.first_name','like','%'.$request->keyword.'%');
           $orders = $orders->orWhere('orders.mobile','like','%'.$request->keyword.'%');
           $orders = $orders->orWhere('orders.id','like','%'.$request->keyword.'%');
        }
        $orders = $orders->paginate(10);

        // $data['orders'] =  $orders ;
        // return view('admin.orders.list',$data);

        return view('admin.orders.list',[
            'orders' => $orders
        ]);
    }

    public function Detail($orderId){

     $order =  Order::select('orders.*','countries.name as countryName')
                     ->where('orders.id',$orderId)
                     ->leftJoin('countries','countries.id','orders.country_id')->first();


    $orderItems = OrderItem::where('order_id',$orderId)->get();
        return view('admin.orders.detail',[
            'order' => $order,
            'orderItems' => $orderItems,
        ]);
    }

    public function changeOrderStatus(Request $request, $orderId){
      $order =  Order::find($orderId);

      $order->status = $request->status;
      $order->shipped_date = $request->shipped_date;
      $order->save();

    //   session()->flash('status','Order Status Updated Successfully.');
      return response()->json([
        'status'    => true,
        'message'   => 'Order Status Updated Successfully.'
      ]);
    }
    
    public function sendInvoiceEmail(Request $request, $orderId) {
      orderEmail($orderId, $request->userType ); // "orderEmail" is a helper methods commig from helper
     
      return response()->json([
        'status'    => true,
        'message'   => 'Order Email Sent Successfully.'
      ]);
    }
}
