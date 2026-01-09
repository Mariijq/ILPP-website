<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Collaborator extends Model
{
    use Searchable;

    protected $fillable = ['name', 'bio'];

    protected $casts = [
        'name' => 'array',
        'bio' => 'array',
    ];
}
