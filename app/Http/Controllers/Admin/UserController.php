<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   public function index(Request $request){
    
    $users = User::latest();
   
    if(!empty($request->get('keyword'))) {
        $users = $users->where('name','like','%'.$request->get('keyword').'%');
        $users = $users->orwhere('email','like','%'.$request->get('keyword').'%');
        $users = $users->orwhere('phone','like','%'.$request->get('keyword').'%');
    }
    $users = $users->paginate(10);

    return view('admin.users.list',[
        'users'  => $users,
    ]);
   }

   public function create(Request $request) {
     return view('admin.users.create',[
      // 'users' =>$users,
     ]);
   }

   public function store(Request $request) {
    $validator = Validator::make($request->all(),[
          'name'    => 'required',
          'email'   => 'required|email|unique:users',
          'password'=> 'required|min:5',
          'phone'   =>  'required|min:11|max:15',
    ]);

    if($validator->passes()) {
        $user = new User();
        
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone    = $request->phone;
        $user->status   = $request->status;
        $user->save();

        return response()->json([
          'status'  => true,
          'message' => 'User added successfully.'
        ]);
    } else {
      return response()->json([
        'status'  => false,
        'errors'  => $validator->errors()
      ]);
    }
   }
   public function edit(Request $request, $id) {      
    $user = User::find($id);
    
    if($user == null) {
      $message = 'User not found.';     
        session()->flash('error', $message);
        return redirect()->route('users.index');
    }

    return view('admin.users.edit',compact('user'));
   }

   public function update(Request $request, $id) {

      $user = User::find($id);
      
      if($user == null) {
        $message = 'User not found.';     
          session()->flash('error', $message); 

          return response()->json([
            'status'  => true,
            'message' => $message,
          ]);
      }
      $validator = Validator::make($request->all(),[
            'name'    => 'required',
            'email'   => 'required|email|unique:users,email,'.$id.',id',
            'phone'   =>  'required|min:11|max:15',
      ]);

      if($validator->passes()) {

          $user->name     = $request->name;
          $user->email    = $request->email;
         
          if($request->password != '') {
            $user->password = Hash::make($request->password);
          }
        
          $user->phone    = $request->phone;
          $user->status   = $request->status;
          $user->user_type   = $request->user_type;
          $user->save();

          return response()->json([
            'status'  => true,
            'message' => 'User updated successfully.'
          ]);
      } else {
        return response()->json([
          'status'  => false,
          'errors'  => $validator->errors()
        ]);
      }
    }
    public function destroy($id) {

      $user = User::find($id);

      if($user == null) {
        $message = 'User not found';
        session()->flash('error', $message);

        return response()->json([
          'status'  => true,
          'message' => $message
        ]);
      }
      $user->delete();

      session()->flash('success', 'User Deleted successfully');
      return response()->json([
        'status'  => true,
        'message' => 'User Deleted successfully.'
      ]);
    }
}
