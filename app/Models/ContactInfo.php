<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ContactInfo extends Model
{
    use Searchable;
    protected $fillable = [
        'address',
        'email',
        'phone',
        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'map_embed',
    ];
}
