<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ContactMessage extends Model
{
    use Searchable;

    protected $table = 'contact_messages'; // make sure table exists

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
}
