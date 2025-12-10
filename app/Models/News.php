<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class News extends Model
{
    use Searchable;

    protected $fillable = [
        'title',
        'subtitle',
        'date',
        'short_description',
        'detailed_description',
        'image',
    ];

    public function media()
    {
        return $this->hasMany(NewsMedia::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id, // Add this
            'title' => (string) $this->title,
            'subtitle' => (string) $this->subtitle,
            'short_description' => (string) $this->short_description,
            'detailed_description' => (string) $this->detailed_description,
        ];
    }
}
