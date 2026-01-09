<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
use Toastr;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string',
        ]);

        try {
            // Save message to DB
            $contactMessage = ContactMessage::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone ?? '', // avoid null
                'message' => $request->message,
            ]);

            // Send email to admin
            $adminEmail = env('MAIL_ADMIN_EMAIL', 'ilpp.infodesk@gmail.com'); // use env
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ContactMessageMail($contactMessage));
            }

            Toastr::success('Your message has been sent successfully!', ['title' => 'Success']);
            return redirect()->back();

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);
            return redirect()->back()->withInput();
        }
    }
}
