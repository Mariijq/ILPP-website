<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Partner extends Model
{
    use Searchable;
    protected $fillable = [
        'name',
        'logo',
        'website',
        'order',
    ];  

    protected $casts = [
        'name' => 'array',
    ];
    public function getLocalizedNameAttribute()
{
    $locale = app()->getLocale();
    return $this->name[$locale] ?? $this->name['en'] ?? '';
}

}
