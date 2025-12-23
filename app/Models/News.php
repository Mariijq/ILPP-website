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
        'short_description',
        'detailed_description',
        'image',
        'date',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'short_description' => 'array',
        'detailed_description' => 'array',
        'date' => 'date',
    ];

    public function media()
    {
        return $this->hasMany(NewsMedia::class);
    }

public function toSearchableArray()
{
    return [
        'id' => $this->id,

        'title' => implode(' ', $this->title ?? []),
        'subtitle' => implode(' ', $this->subtitle ?? []),
        'short_description' => implode(' ', $this->short_description ?? []),
        'detailed_description' => implode(' ', $this->detailed_description ?? []),
    ];
}
}
