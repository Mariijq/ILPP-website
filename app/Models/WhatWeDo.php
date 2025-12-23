<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class WhatWeDo extends Model
{
    use Searchable;
    protected $fillable = [
        'title',
        'leadership',
        'research',
        'public_policy',
    ];

    protected $casts = [
        'title' => 'array',
        'leadership' => 'array',
        'research' => 'array',
        'public_policy' => 'array',
    ];
}
