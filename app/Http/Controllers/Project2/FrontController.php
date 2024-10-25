<?php
// Prooject 2
namespace App\Http\Controllers\Project2;

use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use App\Models\Page;
use App\Models\Product2;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index(){
       $products = Product2::where('is_featured','Yes')->orderBy('id','DESC')->take(8)->where('status',1)->get();
      
       $data['featuredProducts']  =$products;

       $latestProducts  =   Product2::orderBy('id','DESC')->take(8)->where('status',1)->get();
       $data['latestProducts']  =  $latestProducts;
        return view('project2_front.home',$data);
    }

    public function add_To_Wishlist(Request $request) {

        if(Auth::check()==false) {

            session(['url.intended' => url()->previous()]);
            return response()->json([
                'status' => false,
            ]);
        }
        Wishlist::updateOrCreate(
                [
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $request->id,
                ],
                [
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $request->id,
                ]
            );
        // $wishlist              =    new Wishlist();
        // $wishlist->user_id     =    Auth::user()->id;
        // $wishlist->product_id  =    $request->id;
        // $wishlist->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Product added to your wishlist.'
        ]);

    }
    public function page($slug) {
        $page = Page::where('slug',$slug)->first();
        if($page== null) {
            abort(404);
        }
        return view('project2_front.page',[
            'page' => $page,
        ]);
    }
    public function sendContactEmail(Request $request){
         $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required|email',
            'subject'   => 'required|min:10'
        ]);

        if ($validator->passes()) {
           // Email Send
            $mailData =[
                'name'      => $request->name,
                'email'     => $request->email,
                'subject'   => $request->subject,
                'message'   => $request->message,
                'mail_subject'  => 'You have reveived a contact email',
            ];
                $admin = User::where('id',1)->first();
                Mail::to($admin->email)->send(new ContactEmail($mailData) );

                session()->flash('success','Thanks you. We have received you mail,we will get back to you very soon.');
                return response()->json([
                    'status' => true,
                ]);
        } else {
            return response()->json([
                'status' =>false,
                'errors'  =>$validator->errors(),
            ]);
        }
    }
}
