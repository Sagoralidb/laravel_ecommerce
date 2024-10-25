<?php

// namespace App\Http\Controllers\Site;

// use App\Http\Controllers\Controller;
// use App\Models\Payment;
// use App\Models\Product;
// use App\Models\PurchasedProduct;
// use Illuminate\Http\Request;
// use Stripe\Charge;

// class indexController extends Controller
// {
    
    // public function openHomePage()
    // {
    //     $products    = Product::paginate(9);
         

       
    //         return view('site.index')->with('products',$products); //3rd way to send data
            
    // }
    
    // public function openProductDetails($slug)
    // {
    //     $product    = Product:: where('slug', $slug)->first();
       
 
    //     if(! $product){
    //         abort(404);
    //     }
    //     return view('site.product-details', ['product' => $product ]);
        
    // }

    // public function openCartPage()
    // {
    //     if(! auth()->check()){
    //         return back()->with('alert-danger','You are not loged in.');
    //     }
    //     $cartItems = PurchasedProduct::where('user_id', auth()->id() )->get();

    //     return view('site.cart',['cartItems'=>$cartItems]);
    // }

    // public function openCheckoutPage()
    // {
    //     $products = PurchasedProduct::where('user_id', auth()->id() )->get();
    //     return view('site.checkout',['products'=> $products]);
    // }

    // public function addProductIntoCart( Request $request)
    // {
    //     $quantity   =   $request->quantity ? $request->quantity: 1;
        
    //     if(! auth()->check()){

    //         $request->session()->flash('alert-danger','Please login to performe the action');
    //         return to_route('site.home'); 
            // return response()->json([
            //     'error' => 'Your are not loged in, Please login to performe the action'
            // ], 403);

        }
        //return $request->all();
        
    //     $product_id = $request->product_id;

    //     $product    = Product::find($product_id);

    //     if( ! $product ){
    //         return response()->json([
    //         'error' => 'Unable to find this product'
    //         ], 404);
    //     }

    //     if( $product->quantity == 0 || $product->quantity == null ){
    //         return response()->json([
    //         'error' => 'The product is out of stock, please wait. If this product is available again we will notify you by email.'
    //         ], 404);
    //     }
    
    //     if($product->quantity < $quantity){

    //         $request->session()->flash('alert-danger','The product is unsufficient, Please lower the quantity. If this product is available again we will notify you by email.');

    //         return to_route('site.home');    

    //     }
    // $user   =   auth()->user();
    
    //  $purchasedProduct=   PurchasedProduct::where('user_id', $user->id)
    //                         ->where('name', $product->name)
    //                         ->where('price', $product->price)
    //                         ->first();
    // try{
    //     if($purchasedProduct){
            
    //             $purchasedProduct->update([
                    
    //                 'name'      =>  $product->name,
    //                 'price'     =>  $product->price,
    //                 'quantity'  =>  $purchasedProduct->quantity + $quantity,
    //                 'image'     =>  $product->gallery ? $product->gallery->image:'No Image Found',
    //             ]);
    //     } 
    //     else{
    //         PurchasedProduct::create([
    //                 'user_id'   =>  $user->id,
    //                 'name'      =>  $product->name,
    //                 'price'     =>  $product->price,
    //                 'quantity'  =>  $quantity,
    //                 'image'     =>  $product->gallery ? $product->gallery->image:'No Image Found',

    //             ]);
    //     }

    //     $product->update([
    //         'quantity'  => $product->quantity -$quantity
    //     ]);

            
    // }   
    //     catch(\Exception $Ex){
    //         return response()->json([
    //             'error'          => 'Faile due to the error,' .$Ex->getMessage()
    //            ], 401);
    //     }
    // if($request->quantity){

    //     $request->session()->flash('alert-success','Product Added Successfully.');

    //     return to_route('site.home');
    // }
    // else{

    //    return response()->json([
    //     'message'          => 'Product Added To The Cart Successfully.'
    //    ], 201);
    // }
     


    // }
    
    // public function deleteItemFromCart($productId)
    // {
    //     $product    = PurchasedProduct::find($productId);

    //     if(! $product){
    //         abort('403','No Item found');
    //     }
       
    //     $product->delete();

    //     request()->session()->flash('alert-success','Product removed successfully');

    //     return back();

    // }

    // public function updateCartQuantity(Request $request)
    // {
    //     $qty = $request->qty; // Assign qty value
    //     $product_id= $request->product_id;
    //     $product = PurchasedProduct::find($product_id);
    
    //     if(! $product){
    //         return response()->json([
    //             'error' =>'No Product Found.'
    //         ], 404);
    //     }
    
    //     // Update quantity
    //     $product->update([
    //         'quantity' => $qty  
    //     ]);
    
    //     return response()->json([
    //         'product_price' => $product->price * $qty,
    //         'product_id'    => $product->id
    //     ], 201);
    // }

    // public function calculateTotalItemsAmount()
    // {
    //     $products   =PurchasedProduct::where( 'user_id', auth()->id() )->get();

    //    $totalAmount     = 0;

    //     foreach ($products as $product) {
    //       $totalAmount   += $product->price *$product->quantity;
    //     }

    //     return response()->json([
    //         'total_amount'  =>$totalAmount
    //     ], 201);
    // }

    // public function chargeCustomer(Request $request)
    // {   
    //     \Stripe\Stripe::setApiKey(config('stripe.secret_key'));
        
    //    // $cartTotal      = $request->cartItemsTotalAmount;
    //     $totalAmount    = $request->cartItemsTotalAmount;
    //     $currency       = config("stripe.currency");
    //     $quantity       = 1 ;       //পরে get ক রে নিব বা অটোমেটিক করে দিব।
    //     $coponCode      = $request->coupon_code;
    //     $paidAmount     = 0;

    // try{
    //     if($coponCode){
    //         $session = \Stripe\Checkout\Session::create([
    //      'line_items'    => [[
    //          'price_data'    => [
    //              'currency'      => $currency,
    //              'unit_amount'   => $totalAmount * 100,
    //              'product_data'  => [
    //                  'name'      => 'Books',
    //              ],
    //          ],
    //          'quantity'      => 1,
    //      ]],
    //          'mode'          => 'payment',  

    //          'discounts' => [[
    //              'coupon' =>  $coponCode,
    //          ]], 

    //      'success_url'   => config('app.url') . '/success',
    //      'cancel_url'    => config('app.url') . '/error',   
    //  ]); 
    //  }

    //  else{
    //      $session = \Stripe\Checkout\Session::create([
    //          'line_items'    => [[
    //              'price_data'    => [
    //                  'currency'      => $currency,
    //                  'unit_amount'   => $totalAmount * 100,
    //                  'product_data'  => [
    //                      'name'      => 'Books',
    //                  ],
    //              ],
    //              'quantity'      => 1,
    //          ]],
    //              'mode'          => 'payment',      
 
    //          'success_url'   => config('app.url') . '/success',
    //          'cancel_url'    => config('app.url') . '/error',   
    //      ]); 
    //  }
   
    // $payment   =new Payment();
    // $payment->preventAttrSet =true;

    // $payment->user_id           = auth()->id();
    // $payment->transaction_id    = $session ? $session->id: '';
    // $payment->amount            = $totalAmount;
    // $payment->currency          = config('stripe.currency');
    // $payment->product_name      = 'Book';
    // $payment->quantity          = $quantity ;
    // $payment->status            = 'in-active'; 
    // $payment->save();

    //  if ($session->url) {
    //      session()->put('payment_id', $payment ? $payment->id: ''  );
    //      session()->put('transaction_id', $payment ? $payment->transaction_id: ''  );
 
    //      return redirect($session->url);
    //  } else {
    //      abort(401, 'Payment Process Failed');
    //  }

    // }
    // catch(\Exception $ex){
    //     return back()->withInput()->withErrors($ex->getMessage());
    // }


    // }
    
    // public function openSuccessPage()
    // {
    //     if(session()->has('payment_id')){
    //         $paymentId = session()->get('payment_id');
    //         $transaction_id = session()->has('transaction_id') ? session()->get('transaction_id'):'';
           
    //         $payment = Payment::find($paymentId);
    
    //         if(! $payment){
    //             abort(404,'Unable Find The Record.Please contact to Administration about your transaction'.$transaction_id);
    //         }
    //         $payment->update([
    //             'status'=>'processed',
    //         ]);
    //     }
    //     else{
    //         abort(404,'Unable Find The Record.Please contact to Administration about your transaction'.$transaction_id);
    //     }
    //     return view('site.success');  
    // }
    
    // public function openErrorPage()
    // {
    //     return view('site.error');
    // }
    

}
