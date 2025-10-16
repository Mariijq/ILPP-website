<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadHub extends Model
{
        use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'description',
    ];

}
