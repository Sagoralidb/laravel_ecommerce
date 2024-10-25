<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class SettingController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    public function processChangePassword(Request $request)
    {
        // Get the currently authenticated admin
        $admin = Auth::guard('admin')->user();

        // Debugging: Check if admin is authenticated
        if (!$admin) {
            return response()->json([
                'status' => false,
                'error' => 'Admin not authenticated',
                'admin' => Auth::guard('admin')->user(), // Check if any user is returned
                'auth_guard' => Auth::guard('admin')->check(), // Check if guard is active
            ]);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {
            // Check if the old password matches the current password
            if (!Hash::check($request->old_password, $admin->password)) {
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'old_password' => ['Your old password is incorrect'],
                    ],
                ]);
            }

            // Update the admin's password
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            
            session()->flash('success','New password updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'New password updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
}
