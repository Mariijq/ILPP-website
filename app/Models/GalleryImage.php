<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class GalleryImage extends Model
{
    use Searchable; 
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'category',
    ];
}
