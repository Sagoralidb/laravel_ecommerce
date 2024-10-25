<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Check if the user is an admin
            if ($user->isAdmin()) {
                // Login success
                return redirect()->intended('admin/dashboard');
            } else {
                // Logout the non-admin user
                Auth::guard('admin')->logout();
                session()->flash('error', 'The provided credentials do not match our records.');
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }
        }

        // Login failed
        session()->flash('error', 'The provided credentials do not match our records.');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->flash('success', 'You are logged out successfully.');
        return redirect('/admin/login');
    }
}
