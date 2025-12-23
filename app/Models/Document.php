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
        protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => implode(' ', $this->title ?? []),
            'description' => implode(' ', $this->description ?? []),
        ];
    }
}
