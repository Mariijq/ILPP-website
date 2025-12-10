<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class History extends Model
{
    use Searchable;
    protected $fillable = [
        'description',
        'title',
    ];
}
