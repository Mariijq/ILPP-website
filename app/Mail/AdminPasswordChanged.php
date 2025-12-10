<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPasswordChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // can hold 'new_password' or 'reset_url'

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Admin Password Notification')
                    ->view('emails.admin_password_changed')
                    ->with($this->data);
    }
}
