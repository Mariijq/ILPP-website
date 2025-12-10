<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class LeadHub extends Model
{
    use Searchable;
    protected $fillable = [
        'title',
        'url',
        'description',
    ];

}
