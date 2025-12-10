<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;               

class Document extends Model
{
    use Searchable;
    protected $fillable = [
        'title',
        'file_path',
        'description',
    ];
}
