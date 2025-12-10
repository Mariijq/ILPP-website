<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AdminPasswordChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Toastr;

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
            Toastr::success('Logged in successfully!', ['title' => 'Success']);

            return redirect()->route('backend.dashboard');
        }

        Toastr::error('Invalid credentials', ['title' => 'Error']);

        return back();
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('backend_logged_in');
        Toastr::info('You have been logged out.', ['title' => 'Info']);

        return redirect()->route('backend.login');
    }

    // Show change password form
    public function editPassword()
    {
        return view('backend.change-password');
    }

    // Handle change password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($request->current_password !== env('ADMIN_PASSWORD')) {
            Toastr::error('Current password is incorrect.', ['title' => 'Error']);

            return back();
        }

        // Send email notification
        Mail::to(env('ADMIN_EMAIL'))->send(new AdminPasswordChanged([
            'new_password' => $request->new_password,
        ]));

        Toastr::success('Password changed successfully. An email has been sent.', ['title' => 'Success']);

        return back();
    }

    // Show forgot password form
    public function showForgotForm()
    {
        return view('backend.passwords.email');
    }

    // Send reset link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if ($request->email !== env('ADMIN_EMAIL')) {
            Toastr::error('Email not found.', ['title' => 'Error']);

            return back();
        }

        $token = Str::random(60);
        session(['admin_reset_token' => $token]);

        $resetUrl = route('backend.password.reset', $token);

        Mail::to(env('ADMIN_EMAIL'))->send(new AdminPasswordChanged([
            'reset_url' => $resetUrl,
        ]));

        Toastr::success('Password reset link sent to your email.', ['title' => 'Success']);

        return back();
    }

    // Show reset password form
    public function showResetForm($token)
    {
        $sessionToken = session('admin_reset_token');

        if (! $sessionToken || $token !== $sessionToken) {
            Toastr::error('Invalid or expired token.', ['title' => 'Error']);

            return redirect()->route('backend.login');
        }

        return view('backend.passwords.reset', ['token' => $token]);
    }

    // Handle reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $sessionToken = session('admin_reset_token');

        if (! $sessionToken || $request->token !== $sessionToken) {
            Toastr::error('Invalid or expired token.', ['title' => 'Error']);

            return back();
        }

        // Send email notification
        Mail::to(env('ADMIN_EMAIL'))->send(new AdminPasswordChanged([
            'new_password' => $request->new_password,
        ]));

        session()->forget('admin_reset_token');

        Toastr::success('Password reset successfully. Check your email.', ['title' => 'Success']);

        return redirect()->route('backend.login');
    }
}
