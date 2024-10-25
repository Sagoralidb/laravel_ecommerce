<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{
    public function index(Request $request){
        $DiscountCoupons =   DiscountCoupon::latest();

        if(! empty($request->get('keyword')) ){
            // $DiscountCoupons = $DiscountCoupons->where('name','like','%'. $request->get('keyword') .'%');
            $DiscountCoupons = $DiscountCoupons->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->get('keyword') . '%')
                      ->orWhere('code', 'like', '%' . $request->get('keyword') . '%')
                      ->orWhere('discount_amount', 'like', '%' . $request->get('keyword') . '%');
            });
            
        }
    $DiscountCoupons = $DiscountCoupons->paginate(10);
        return view('admin.coupon.list',compact('DiscountCoupons'));
    }
    public function create(){
        return view('admin.coupon.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'code'      => 'required',
            'type'      => 'required',
            'discount_amount'   =>'required|numeric',
            'status'    =>  'required',
        ]);
        
        if($validator->passes()){

            //We are going To Check : Start Date must be greter then current date
            if(!empty($request->starts_at)){
                $now = Carbon::now();
                $starAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

                if($starAt->lte($now)== true){
                    return response()->json([
                        'status'    => false,
                        'errors'     => ['starts_at'=>'Start date can not be less then current date & time'],
                    ]);
                }
            }
            //We are going To Check : Expire Date must be greter then Start date
            if(!empty($request->starts_at) && !empty($request->expires_at)){
                $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
                $starAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

                if($expiresAt->gt($starAt) == false){
                    return response()->json([
                        'status'    => false,
                        'errors'     => ['expires_at'=>'Expiry date must be greater then start date'],
                    ]);
                }
            }

            $discountCode   =   new DiscountCoupon();
            $discountCode->code     =   $request->code;
            $discountCode->name     =   $request->name;
            $discountCode->max_uses =   $request->max_uses;          
            $discountCode->max_uses_user    =   $request->max_uses_user;
            $discountCode->type             =   $request->type;
            $discountCode->discount_amount  =   $request->discount_amount;
            $discountCode->min_amount       =   $request->min_amount;
            $discountCode->status           =   $request->status;
            $discountCode->starts_at        =   $request->starts_at;
            $discountCode->expires_at       =   $request->expires_at;
            $discountCode->description       =   $request->description;
            $discountCode->save();

            $message    = 'Discount coupon added successfully';

            session()->flash('success',$message);
            return response()->json([
                'status'    => true,
                'message'   => $message
                ]);

            } else{
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors(),
                ]);
            }
        }
    public function edit($id, Request $request){
            $coupon = DiscountCoupon::find($id);
            
            if($coupon == null ) {
                session()->flash('error','No record found');
                return redirect()->route('coupons.index');
            }
            $data['coupon'] = $coupon;
            return view('admin.coupon.edit', $data);
        }

    public function update($id, Request $request){
        $discountCode   =  DiscountCoupon::find($id);

        if($discountCode == null){
            session()->flash('error','Record not found');
            return response()->json([
                'status' => true,
            ]);
        }
        $validator = Validator::make($request->all(),[
            'code'      => 'required',
            'type'      => 'required',
            'discount_amount'   =>'required|numeric',
            'status'    =>  'required',
        ]);
        
        if($validator->passes()){

            //Check : Start Date must be greter then current date
            // if(!empty($request->starts_at)){
            //     $now = Carbon::now();
            //     $starAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

            //     if($starAt->lte($now)== true){
            //         return response()->json([
            //             'status'    => false,
            //             'errors'     => ['starts_at'=>'Start date can not be less then current date & time'],
            //         ]);
            //     }
            // }

            //Check : Expire Date must be greter then Start date
            if(!empty($request->starts_at) && !empty($request->expires_at)){
                $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
                $starAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

                if($expiresAt->gt($starAt) == false){
                    return response()->json([
                        'status'    => false,
                        'errors'     => ['expires_at'=>'Expiry date must be greater then start date'],
                    ]);
                }
            }

            
            $discountCode->code     =   $request->code;
            $discountCode->name     =   $request->name;
            $discountCode->max_uses =   $request->max_uses;          
            $discountCode->max_uses_user    =   $request->max_uses_user;
            $discountCode->type             =   $request->type;
            $discountCode->discount_amount  =   $request->discount_amount;
            $discountCode->min_amount       =   $request->min_amount;
            $discountCode->status           =   $request->status;
            $discountCode->starts_at        =   $request->starts_at;
            $discountCode->expires_at       =   $request->expires_at;
            $discountCode->description       =   $request->description;
            $discountCode->save();

            $message    = 'Discount coupon updated successfully';

            session()->flash('success',$message);
            return response()->json([
                'status'    => true,
                'message'   => $message
            ]);

        } else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

    }
    public function destroy($id, Request $request){
        $discountCode     =    DiscountCoupon::find($id);

        if($discountCode == null){
           $request->session()->flash('error','No reord found');
            return response()->json([
                'status'    => true,
            ]);
        }
        $discountCode->delete();
        session()->flash('success','The discount record deleted successfully');
        return response()->json([
            'status'    => true,
        ]);
            
        }
}

           