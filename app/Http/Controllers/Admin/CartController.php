<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product2;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $product = Product2::with('products_images')->find($request->id);
        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }
    
        $productImage = !empty($product->products_images) ? $product->products_images->first() : null;
    
        $cartItem = Cart::add($product->id, $product->title, 1, $product->price, [
            'productImage' => $productImage,
            'size' => $request->size
        ]);
    
        if ($cartItem) {
            session()->flash('success', '<strong>' . $product->title . '</strong> - added in cart successfully');
            return response()->json([
                'status' => true,
                'message' => '<strong>' . $product->title . '</strong> - added in cart successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Could not add the product to the cart'
            ]);
        }
    }
    
    
    
    
    
    public function cart(){
        $cartContent   =    Cart::content();
        $data['cartContent']= $cartContent;
        return view('project2_front.cart', $data);
    }

    public function updateCart(Request $request){
        $rowId  =   $request->rowId;
        $qty    =   $request->qty;
        
        // Get item from the cart using rowId
        $itemInfo = Cart::get($rowId);
    
        // Get product model using its id
        $product = Product2::find($itemInfo->id);
    
        // Check if track_qty is enabled
        if($product->track_qty == 'Yes'){
            // Check if requested qty is available in stock
            if($qty <= $product->qty){
                // Update cart if stock is available
                Cart::update($rowId, $qty);
                $message = 'Cart Updated Successfully';
                $status = true;
                session()->flash('success', $message);
            } else {
                // Display error message if requested qty is not available in stock
                $message = "Requested qty ($qty) not available in stock.";
                $status = false;
                session()->flash('error', $message);
            }
        } else {
            // Update cart if tracking quantity is not enabled
            Cart::update($rowId, $qty);
            $message = 'Cart Updated Successfully';
            $status = true;
            session()->flash('success', $message);
        }
        
        // Return JSON response
        return response()->json([
            'status'    =>   $status,
            'message'   =>  $message
        ]);
    }
    
 public function deleteItem(Request $request){
   //যে আইটেম টা ডিলিট করতে চাই সেটি কি আছে নাকি নাই সেটি চেক করছি।
   $itemInfo =  Cart::get($request->rowId); 
    //আইটেম যদি থাকে 
    if($itemInfo == null) {
        $errorMessage='Item Not Found in the cart.';
        session()->flash('error',$errorMessage);
        return response()->Json([
            'status'    => false,
            'message'   => $errorMessage
        ]);
    }
        // অণ্যথায় পণ্য রিমুভ করার হবে ....

    Cart::remove($request->rowId);   
        $message    =   "The item has been reomve from cart successfully.";
        session()->flash('success',$message);
        return response()->Json([
            'status'    => true,
            'message'   => $message
        ]);
  }

        public function checkout() {
            $discount = 0;
            // if cart is empty redirect to cart page
            if (Cart::count() == 0) {
                return redirect()->route('front.cart');
            }
            // if user is not logged in 
            if (Auth::check() == false) {
                if (!session()->has('url.intended')) {
                    session(['url.intended' => url()->current()]); // এই url.intended CartController থেকে session ম্যাথড থেকে আসছে।
                }
                return redirect()->route('account.login');
            }
            
            $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();
            session()->forget('url.intended');
            $countries  = Country::orderBy('name', 'ASC')->get();

          $subTotal =  Cart::subtotal(2, '.', '');
              // Apply discount Here
            $discount = 0;
            if(session()->has('code')) {
                $code = session()->get('code');

                if ($code->type == 'percent') {
                    $discount = ($code->discount_amount/100) * $subTotal ;
                } else {
                    $discount = $code->discount_amount;
                }
            }

            // শিপিং হিসাব করা
            $totalShippingCharge = 0;
            $grandTotal = 0;
            // Calculate shipping here
            if ($customerAddress != '') {
                $userCountry = $customerAddress->country_id;
                $shippingInfo = Shipping::where('country_id', $userCountry)->first();
                $totalQty = 0;
                
                foreach (Cart::content() as $item) {
                    $totalQty += $item->qty;
                }

                if ($shippingInfo) {
                    $totalShippingCharge = $shippingInfo->amount;
                    $grandTotal = ($subTotal-$discount) + $totalShippingCharge;
                } else {
                    // Shipping information not found for the user's country
                    $totalShippingCharge = 0; // বা আপনি যেভাবে হ্যান্ডেল করতে চান
                }
                
                // $grandTotal = ($subTotal-$discount) + $totalShippingCharge;
            } else {
                $grandTotal = ($subTotal-$discount);
            }

            return view('project2_front.checkout', [
                'countries'          => $countries,
                'customerAddress'    => $customerAddress,
                'totalShippingCharge'=> $totalShippingCharge,
                'discount'           => $discount,
                'grandTotal'         => $grandTotal,
            ]);
        }



        public function processCheckout(Request $request) {
            // Step-1 apply validation to the processcheckout fields
            $validator = Validator::make($request->all(),[
                'first_name'   => 'required|min:3',
                'last_name'    => 'required',
                'email'        => 'required|email',
                'country'      => 'required',
                'address'      => 'required|min:20',
                'city'         => 'required',
                'state'        => 'required',
                'zip'          => 'required',
                'mobile'       => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'message'   => 'Please fix the errors',
                    'status'    => false,
                    'errors'    => $validator->errors()
                ]);
            }
        
            // Step-2 Save the customer Address
            $user = Auth::user();
            CustomerAddress::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id'       => $user->id, 
                    'first_name'    => $request->first_name,
                    'last_name'     => $request->last_name,
                    'email'         => $request->email,
                    'mobile'        => $request->mobile,
                    'country_id'    => $request->country,
                    'address'       => $request->address,
                    'apartment'     => $request->apartment,
                    'city'          => $request->city,
                    'state'         => $request->state,
                    'zip'           => $request->zip,
                ]
            );
        
            // Step-3 Store data in orders table
            if($request->payment_method == 'cod'){
                // Cash on delivery
                $discountCodeId = ''; //$discountCodeId = Null;
                $promoCode      = '';
                $shipping       = 0;
                $discount       = 0;
                $subTotal       = Cart::subtotal(2,'.','');
        
                // Apply discount Here
                if(session()->has('code')) {
                    $code = session()->get('code');
                    if ($code->type == 'percent') {
                        $discount = ($code->discount_amount/100) * $subTotal ;
                    } else {
                        $discount = $code->discount_amount;
                    }
                    $discountCodeId = $code->id;
                    $promoCode  = $code->code;
                }
        
                // $grandTotal = $subTotal + $shipping;
                // Calculate Shipping 
                $shippingInfo = Shipping::where('country_id',$request->country)->first();
                
                $totalQty = 0;
                foreach (Cart::content() as $item) {
                    $totalQty += $item->qty;
                }
                if ($shippingInfo != null) {
                    $shipping =  $shippingInfo->amount ;
                    $grandTotal = ($subTotal - $discount) + $shipping;
                } else {
                    $shippingInfo = Shipping::where('country_id','rest_of_world')->first();
                    $shipping =  $shippingInfo->amount;
                    $grandTotal = ($subTotal - $discount) + $shipping;
                }
        
                // new order
                $order = new Order;
                $order->subtotal    = $subTotal;
                $order->shipping    = $shipping;
                $order->grand_total = $grandTotal;
                $order->discount    = $discount;
                $order->coupon_code_id = $discountCodeId;
                $order->coupon_code  = $promoCode ;
                $order->payment_status  = 'not paid';
                $order->status  = 'pending';
                $order->user_id      = $user->id;
                // Get the customer details
                //>>table name<<        >>form field name<<
                $order->first_name  = $request->first_name;
                $order->last_name   = $request->last_name;
                $order->email       = $request->email;
                $order->mobile      = $request->mobile;
                $order->country_id  = $request->country;
                $order->address     = $request->address;
                $order->apartment   = $request->apartment;
                $order->state       = $request->state;
                $order->city        = $request->city;
                $order->zip         = $request->zip;
                $order->notes       = $request->order_notes;
                $order->save();
        
                // Step-4 Store order Items in to order items table
                foreach (Cart::content() as $item) {
                    $orderItem  = new OrderItem();
                    //>>table name<<            
                    $orderItem->product_id      = $item->id;
                    $orderItem->order_id        = $order->id;
                    $orderItem->name            = $item->name;
                    $orderItem->qty             = $item->qty;
                    $orderItem->price           = $item->price;
                    $orderItem->total           = $item->price * $item->qty;
                    $orderItem->size            = $item->options->size; // Add size to order item
                    $orderItem->save();
                }
                // Update product stock
                $productData = Product2::find($item->id);
                if ($productData->track_qty == 'Yes') {
                    $currentQty = $productData->qty;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->qty = $updatedQty;
                    $productData->save();
                }
        
                // Send Order Email
                orderEmail($order->id);
        
                session()->flash('success','Order placed succcessfully');
        
                Cart::destroy(); // order complete হয়ে গেলে কার্ড empty করার ম্যাথোড
                session()->forget('code'); // After complete order the Coupon code will remove
                
                return response()->json([
                    'message'   => 'Order saved successfully',
                    'orderId'   =>  $order->id,
                    'status'    => true
                ]);
            } else {
                // Handle other payment methods if any
                return response()->json([
                    'message'   => 'Payment method not supported',
                    'status'    => false
                ]);
            }
        }
        

    public function thankyoupage($id){

        return view("layouts.thankyou",[
            'id'    => $id,
        ]);
        
    }

    public function getOrderSummery(Request $request){

        $subTotal = Cart::subtotal(2,'.','');
        $discountString ='';
        // Apply discount Here
        $discount = 0;
        if(session()->has('code')) {
            $code = session()->get('code');

            if ($code->type == 'percent') {
                $discount = ($code->discount_amount/100) * $subTotal ;
            } else {
                $discount = $code->discount_amount;
            }
            $discountString = '<div class="mt-4" id="discount-response">
                                <strong class="mr-5">'.session()->get('code')->code.' </strong>
                                <a class="btn btn-sm text-danger" id="remove-discount"><i class="fa fa-times"></i></a>
                            </div>';
        }


       if($request->country_id > 0) {

        $shippingInfo = Shipping::where('country_id',$request->country_id)->first();
        
        $totalQty = 0;
        foreach (Cart::content() as $item) {
            $totalQty+=$item->qty;
        }
        
        if ($shippingInfo != null) {

            $shippingCharge = $shippingInfo->amount ;
            $grandTotal = ($subTotal - $discount) + $shippingCharge;

            return response()->json([
                'status'        => true,
                'grandTotal'    => number_format($grandTotal,2),
                'discount'      => number_format($discount,2),
                'discountString'=> $discountString,
                'shippingCharge'=> number_format($shippingCharge,2),
            ]);

        } else {
                $shippingInfo = Shipping::where('country_id','rest_of_world')->first();

                $shippingCharge = $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;


                return response()->json([
                    'status'        => true,
                    'grandTotal'    => number_format($grandTotal,2),
                    'discount'      => number_format($discount,2),
                    'discountString'=> $discountString,
                    'shippingCharge'=> number_format($shippingCharge,2),
                ]);
            }

            } else {
                return response()->json([
                    'status'         => true,
                    'grandTotal'     => number_format(($subTotal - $discount),2),
                    'discount'      =>  number_format($discount,2),
                    'discountString'=> $discountString,
                    'shippingCharge' =>number_format(0,2),
                ]);
                }
            }

    public function applyDiscount(Request $request){
        // dd($request->code);

       $code = DiscountCoupon::where('code', $request->code)->first();
       
       if($code == null ){
        return response()->json([
            'status'    => false,
            'message'   => 'Invalid Discount Coupon'
        ]);
       }

      $now  = Carbon::now();
    //  echo $now->format('Y-m-d H:i:s');// let test
      if ($code->starts_at != "") {
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->starts_at);

        if($now->lt($startDate)){
            return response()->json([
            'status' => false,
            'message' =>'Invalid Discount Coupon',
            ]);
        }
      }
      if ($code->expires_at != "") {
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->expires_at);

        if($now->gt($endDate)){
            return response()->json([
            'status' => false,
            'message' =>'Invalid discount coupon',
            ]);
        }
      }
      //coupon max uesd check
      if($code->max_uses>0){
        $couponUsed =Order::where('coupon_code_id', $code->id)->count();
            if($couponUsed>=$code->max_uses){
                return response()->json([
                    'status' => false,
                    'message' =>'Invalid discount coupon',
                    ]);
                }
        }
     
    //coupon max user's uesd check
    if($code->max_uses_user>0){
        $couponUsedByUser = Order::where(['coupon_code_id'=> $code->id,'user_id'=>Auth::user()->id])->count(); 
            if($couponUsedByUser>=$code->max_uses_user){
                return response()->json([
                    'status' => false,
                    'message' =>'You already used this coupon',
                    ]);
                }
        }
        //Minimum amount
        $subTotal = Cart::subtotal(2,'.','');

        if($code->min_amount > 0) {
            if($subTotal < $code->min_amount ){
                return response()->json([
                    'status' => false,
                    'message' => 'Your minimum amount must be $' ./* config('stripe.currency_symbol') . */$code->min_amount,
                    ]);
            }
        }

      session()->put('code', $code);
      return $this->getOrderSummery($request);
    }
    
    public function removeCoupon(Request $request){
        session()->forget('code');
        return $this->getOrderSummery($request);
    }

}

