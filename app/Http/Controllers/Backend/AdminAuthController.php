<?php

namespace App\Http\Controllers\Backend;

use Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('backend.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === env('ADMIN_EMAIL') && $request->password === env('ADMIN_PASSWORD')) {
            $request->session()->put('backend_logged_in', true);
            Toastr::success('Logged in successfully!', ['title'=>'Success']);

            return redirect()->route('backend.dashboard');
        }
        Toastr::error('Invalid credentials', ['title'=>'Error']);

        return back();
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('backend_logged_in');
        Toastr::info('You have been logged out.', 'Info');

        return redirect()->route('backend.login');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $backend = auth()->user(); // or however you get the backend user

        if (! Hash::check($request->current_password, $backend->password)) {
            Toastr::error('Current password is incorrect.', ['title'=>'Error']);

            return back();
        }

        $backend->password = Hash::make($request->new_password);
        $backend->save();
        Toastr::success('Password updated successfully!', ['title'=>'Success']);

        return back();
    }
}
