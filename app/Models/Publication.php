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

    protected $casts = [
        'title' => 'array',
        'short_description' => 'array',
        'detailed_description' => 'array',
        'date' => 'date',
    ];
        public function toSearchableArray(): array
    {
        return [
            'title'    => is_array($this->title)
                ? implode(' ', $this->title)
                : $this->title,

            'short_description' => is_array($this->short_description ?? null)
                ? implode(' ', $this->short_description)
                : ($this->short_description ?? ''),
        ];
    }

}
