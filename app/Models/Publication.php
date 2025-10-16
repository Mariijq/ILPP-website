<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
        use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'date',
        'short_description',
        'detailed_description',
        'image',
        'file',
    ];

    protected $dates = ['date'];

}
