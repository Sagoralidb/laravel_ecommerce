<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController2 extends Controller
{
    public function login(){
        return view('project2_front.account.login');
    }
   
    public function register(){
        return view('project2_front.account.register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'Registration Successful');
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                }
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Either Email or Password is incorrect.']);
            }
        } else {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }
    
    
    public function profile() {
        $userId = Auth::user()->id;

        $countries  = Country::orderBy('name','ASC')->get();
        $user       = User::where('id',$userId)->first();
        // $address = CustomerAddress::where('id',$userId)->first();
        $address = CustomerAddress::where('user_id', $userId)->orderBy('updated_at', 'DESC')->first();

        $data['user'] = $user;
        $data['countries'] = $countries;
        $data['address'] = $address;
        return view('project2_front.account.profile',$data);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login')
        ->with('success','You are successfully logged out');
    }
    //let's update profile data
    public function updateProfile(Request $request){
        $userId = Auth::user()->id;
      $validator = Validator::make($request->all(),[
        'name'  => 'required',
        'email' => 'required|email|unique:users,email,'.$userId.',id',
        'phone' => 'required'
       ]);

       if($validator->passes()){
          $user = User::find($userId);
          $user->name   =   $request->name;
          $user->email  =   $request->email;
          $user->phone  =   $request->phone;
          $user->save();    
          return response()->json([
            'status'    => true,
            'message'   => 'Profile updated successfully.'
          ]);
       } else {
           return response()->json([
            'status' => false,
            'errors' => $validator->errors()
           ]);
       }
    }
     //let's update profile data
     public function updateAddress(Request $request){
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'first_name'   => 'required|min:3',
            'last_name'    => 'required',
            'email'        => 'required|email',
            'country_id'   => 'required',
            'address'      => 'required|min:20',
            // 'apartment'    => 'required',
            'city'         => 'required',
            'state'        => 'required',
            'zip'          => 'required',
            'mobile'       => 'required',
        ]);

       if($validator->passes()){
        //   $user = User::find($userId);
        //   $user->name   =   $request->name;
        //   $user->email  =   $request->email;
        //   $user->phone  =   $request->phone;
        //   $user->save(); 

        CustomerAddress::updateOrCreate(
            ['user_id' => $userId],
            [
                'user_id'       => $userId, 
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'mobile'        => $request->mobile,
                'country_id'    => $request->country_id,
                'address'       => $request->address,
                'apartment'     => $request->apartment,
                'city'          => $request->city,
                'state'         => $request->state,
                'zip'           => $request->zip,
            ]
        );

          return response()->json([
            'status'    => true,
            'message'   => 'Address updated successfully.'
          ]);
       } else {
           return response()->json([
            'status' => false,
            'errors' => $validator->errors()
           ]);
       }
    }
    // Admin Login manage 
    public function adminLogin()
        {
            return view('admin.login'); // Ensure you have a corresponding view file
        }

        public function authenticateAdmin(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($validator->passes()) {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials');
        }
    } else {
        return redirect()->route('admin.login')->withErrors($validator)->withInput();
    }
}


    // Logout admin method
    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout(); // Assuming you have an 'admin' guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You are successfully logged out');
    }

   
    public function orders() {

        $user = Auth::user();

       $orders =  Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();
    
       $data['orders'] = $orders;

        return view('project2_front.account.order',$data);
    }

    public function orderDetail($id){
        $data   =   [];
        $user   =   auth()->user();
        $order  =   Order::where('user_id',$user->id)->where('id',$id)->first();

        //Get te order items
       $orderItems = OrderItem::where('order_id',$id)->get();

       $orderItemsCount = OrderItem::where('order_id',$id)->count();


       $data['order']= $order;
       $data['orderItems']= $orderItems;
       $data['orderItemsCount']= $orderItemsCount;
        return view('project2_front.account.order-detail',$data);
    }
    public function wishlist() {
    $wishlists  =  Wishlist::where('user_id', Auth::user()->id)->with('product')->get(); //with('product') is comming from wishlist model
    $data               =   [];
    $data['wishlists']  =   $wishlists;
    return view('project2_front.account.wishlist',$data);
    }

    public function remove_Wishlist_Product(Request $request) {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)
                            ->where('product_id', $request->id)
                            ->first();
    
        if ($wishlist == null) {
            return response()->json([
                'status' => false,
                'message' => 'No item found in wishlist'
            ]);
        } else {
            Wishlist::where('user_id', Auth::user()->id)
                    ->where('product_id', $request->id)
                    ->delete();
            return response()->json([
                'status' => true,
                'message' => 'Wishlist item removed successfully'
            ]);
        }
    }
    
    public function showChange_PasswordForm() {
        return view('project2_front.account.change-password');
    }
    
    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(),[
          'old_password' => 'required',
          'new_password' => 'required|min:5',
          'confirm_password' => 'required|same:new_password',
        ]);
      
        if ($validator->passes()) {
          $user = User::select('id','password')->where('id',Auth::user()->id)->first();
      
          if (Hash::check($request->old_password,$user->password)) {
            User::where('id',$user->id)->update([
              'password' => Hash::make($request->new_password)
            ]);
      
            session()->flash('success','Your Password Has Changed Successfully');
      
            // Option 1: Redirect user to confirmation page
            // return redirect()->route('account.changePasswordConfirmation');
      
            // Option 2: Return JSON for AJAX handling
            return response()->json([
              'status' => true,
            ]);
          } else {
            session()->flash('error','Your old password is incorrect');
            return response()->json([
              'status' => false,
              'errors' => $validator->errors()
            ]);
          }
        } else {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors()
          ]);
        }
      }
      public function forgatePassword() {
        return view('project2_front.account.forgote-password');
      }

      public function processForgatePassword(Request $request) {
        $validator =    Validator::make($request->all(),[
                'email' => 'required|email|exists:users,email',
            ]);

        if ($validator->fails()) {
            return redirect()->route('front.forgatePassword')->withInput()->withErrors($validator);
        }
        $token = str::random(60);

        DB::table('password_reset_tokens')->where('email',$request->email)->delete(); // we have deleted the prvious record before insert

        DB::table('password_reset_tokens')->insert([ //record insert
            'email' => $request->email,
            'token' => $token,
            'created_at'=> now()
        ]);

        // send email

        $user = User::where('email',$request->email)->first();
        $formData = [
            'token' => $token,
            'user'  => $user, 
            'mailSubject' => 'You have request to reset your password'
        ];
        Mail::to($request->email)->send(new ResetPasswordEmail($formData));
        
        return redirect()->route('front.forgatePassword')->with('success','Please check your mail to reset the password');
      }

      public function resetPassword($token) {

      $tokenExist =  DB::table('password_reset_tokens')->where('token',$token)->first();
       if ($tokenExist == null) {
            return redirect()->route('front.forgatePassword')->with('error','Invalid request,please try again.');
       }

      return view('project2_front.account.reset-password',[
                'token' => $token,
      ]);
      }

      public function processResetPassword(Request $request) {
        $token = $request->token;

        $tokenObj =  DB::table('password_reset_tokens')->where('token',$token)->first();
       if ($tokenObj == null) {
            return redirect()->route('front.forgatePassword')->with('error','Invalid request,please try again.');
         }

         $user = User::where('email', $tokenObj->email)->first();

            $validator =    Validator::make($request->all(),[
                'new_password' => 'required|min:5',
                'confirm_password' => 'required|same:new_password',
            ]);

            if ($validator->fails()) {
                return redirect()->route('front.resetPassword',$token)->withErrors($validator);
            }
            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            DB::table('password_reset_tokens')->where('email',$user->email)->delete();// delete token after update password
            return redirect()->route('account.login')->with('success','You have successfully updated your password.');
      }

}
