<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Project extends Model
{
    use Searchable;
        protected $fillable = [
        'title',
        'date',
        'short_description',
        'detailed_description',
        'image',
        'status'
    ];

    protected $dates = [
        'date', 
    ];

}
