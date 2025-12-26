<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TeamMember extends Model
{
    use Searchable;

    protected $fillable = [
        'name',
        'position',
        'bio',
        'image',
        'order',
        'facebook',
        'linkedin',
    ];

    protected $casts = [
        'name' => 'array',
        'position' => 'array',
        'bio' => 'array',
    ];

    public function getLocalizedNameAttribute()
    {
        $locale = app()->getLocale();

        return $this->name[$locale] ?? $this->name['en'] ?? '';
    }

    public function getLocalizedPositionAttribute()
    {
        $locale = app()->getLocale();

        return $this->position[$locale] ?? $this->position['en'] ?? '';
    }

    public function getLocalizedBioAttribute()
    {
        $locale = app()->getLocale();

        return $this->bio[$locale] ?? $this->bio['en'] ?? '';
    }
}
