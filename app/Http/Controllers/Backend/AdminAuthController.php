<?php

namespace App\Http\Controllers;

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
            return redirect()->route('backend.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('backend_logged_in');
        return redirect()->route('backend.login');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $backend = auth()->user(); // or however you get the backend user

    if (!Hash::check($request->current_password, $backend->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    $backend->password = Hash::make($request->new_password);
    $backend->save();

    return back()->with('success', 'Password updated successfully.');
}

}
