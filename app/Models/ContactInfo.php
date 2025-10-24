<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'address',
        'email',
        'phone',
        'facebook',
        'instagram',
        'linkedin',
        'map_embed',
    ];
}
