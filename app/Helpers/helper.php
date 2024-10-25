<?php

use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\Country;
use App\Models\Order;
use App\Models\Page;
use App\Models\product2_images;
use Illuminate\Support\Facades\Mail;
function getCategories(){
    return Category::orderBy('name','ASC')
    ->with('sub_category')
    ->orderBy('id','DESC')
    ->where('status',1)
    ->where('showHome','Yes')
    ->get();
}
function getProductImage($productId){
  return  product2_images::where('product_id',$productId)->first();
}
// We have just created a funcion to order model to email

function orderEmail($orderId, $userType = "customer") {
  $order = Order::where('id', $orderId)->with(['items', 'user'])->first();
  
  
  if (!$order) {
      \Log::info('Order not found for ID: ' . $orderId);
      return; // Order not found
  }

  if ($userType == 'customer') {
      $subject = 'Thank you for your order';
      $email = $order->email;
  } else {
      $subject = 'You have received an order';
      $email = env('ADMIN_EMAIL');
  }

  // Checking if $order->user is not null before accessing name
  if ($order->user) {
    \Log::info('Order found for ID: ' . $orderId . ' with User: ' . $order->user->name);
} else {
    \Log::info('Order found for ID: ' . $orderId . ' but User is null');
}


  $mailData = [
      'subject' => $subject,
      'order' => $order,
      'user' => $order->user, // Adding user to mailData
      'userType' => $userType,
  ];

  Mail::to($email)->send(new OrderEmail($mailData));
}

function getCountryInfo($id) {
  return Country::where('id', $id)->first();
}

//Helpers for Static Pages

function staticPages() {
  $page = Page::orderBy('name','ASC')->get();
  return $page;
}

?>