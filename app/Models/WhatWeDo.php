<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatWeDo extends Model
{
    protected $fillable = [
        'title',
        'leadership',
        'research',
        'public_policy',
    ];
}
