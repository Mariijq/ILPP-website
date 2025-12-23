<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use Searchable;
    protected $fillable = [
        'vision',
        'mision',
        'goals',
    ];
        protected $casts = [
        'vision' => 'array',
        'mision' => 'array',
        'goals' => 'array',
    ];

}
