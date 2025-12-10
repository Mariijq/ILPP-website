<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Publication extends Model
{
    use Searchable;
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
