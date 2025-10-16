<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
        protected $fillable = [
        'title',
        'date',
        'short_description',
        'detailed_description',
        'image',
    ];

    protected $dates = [
        'date', 
    ];

}
