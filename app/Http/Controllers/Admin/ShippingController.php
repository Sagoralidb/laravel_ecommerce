<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function create(){
      $countries  =  Country::get();

      $shippingCharges  =  Shipping::select('shipping_charges.*','countries.name')
                          ->leftJoin('countries','countries.id','shipping_charges.country_id')->get();// shipping charge কে ভিউতে লিস্ট আকারে শো করাব তাই এখানে get করলাম।

      $data['countries']    =  $countries;
      $data['shippingCharges']    =  $shippingCharges;//// shipping charge কে ভিউতে পাঠালাম 

     
      return view('admin.shipping.create', $data);
    }

    public function store(Request $request) {
     $validator   =   Validator::make($request->all(),[
            'country' => 'required',
            'amount'  => 'required|numeric'
       ] );

       if ($validator->passes()){
        // database এ ডাটা আগে থেকে আছে কি না তা চেক করে নেলাম
          $count  = Shipping::where('country_id', $request->country)->count();
          if($count >0 ){
            session()->flash('error','Shipping Already Exist');
            return response()->json([
              'status' => true,
            ]);
          }

        $shipping =  new Shipping();
        
        $shipping->country_id  = $request->country;
        $shipping->amount      = $request->amount;
        $shipping->save();

        session()->flash('success','Shipping Charge added successfully.');
        return response()->json([
          'status'  => true,

        ]);

       } else {
            return response()->json([
              'status'  => false,
              'errors'  => $validator->errors()
            ]);
       }
    }
  
  Public function edit($id) {
    $shippingCharge         = Shipping::find($id);
    $countries              =  Country::get();
    $data['shippingCharge'] =  $shippingCharge;
    $data['countries']      =  $countries;
    return view('admin.shipping.edite',$data);
  }

  public function update($id, Request $request) {

      $shipping =  Shipping::find($id);

    $validator   =   Validator::make($request->all(),[
           'country' => 'required',
           'amount'  => 'required|numeric'
      ] );

      if ($validator->passes()){

          if($shipping==null) {
            session()->flash('error','Shipping No Found.');
            return response()->json([
            'status'  => true,
            ]);
        }
      //  $shipping =  Shipping::find($id);
       
       $shipping->country_id  = $request->country;
       $shipping->amount      = $request->amount;
       $shipping->save();

       session()->flash('success','Shipping Updated successfully.');
       return response()->json([
         'status'  => true,

       ]);

      } else {
           return response()->json([
             'status'  => false,
             'errors'  => $validator->errors()
           ]);
      }
   }

   public function destroy($id) {

      $shippingCharge = Shipping::find($id);
       if($shippingCharge==null) {
          session()->flash('error','Shipping No Found.');
          return response()->json([
          'status'  => true,
          ]);
       }
      $shippingCharge->delete();

      session()->flash('success','Shipping Deleted successfully.');
       return response()->json([
         'status'  => true,
        ]);
   }
}
