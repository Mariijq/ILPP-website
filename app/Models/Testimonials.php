<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Testimonials extends Model
{
    use Searchable;

    protected $fillable = ['name', 'designation', 'review', 'image'];

    protected $casts = [
        'name' => 'array',
        'designation' => 'array',
        'review' => 'array',
    ];
}
