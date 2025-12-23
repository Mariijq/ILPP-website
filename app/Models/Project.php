<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'short_description',
        'detailed_description',
        'image',
        'status',
        'date',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'short_description' => 'array',
        'detailed_description' => 'array',
        'date' => 'date',
    ];

//     /**
//      * Generic accessor for localized fields.
//      */
//     public function getLocalizedAttribute($attribute)
//     {
//         $locale = app()->getLocale();
//         $value = $this->$attribute;

//         if (is_array($value)) {
//             return $value[$locale] ?? $value['en'] ?? '';
//         }

//         return $value;
//     }

//     // Explicit localized getters
//     public function getLocalizedTitleAttribute() { return $this->getLocalizedAttribute('title'); }
//     public function getLocalizedSubtitleAttribute() { return $this->getLocalizedAttribute('subtitle'); }
//     public function getLocalizedShortDescriptionAttribute() { return $this->getLocalizedAttribute('short_description'); }
//     public function getLocalizedDetailedDescriptionAttribute() { return $this->getLocalizedAttribute('detailed_description'); }

//     // Optional: formatted date
//     public function getFormattedDateAttribute()
//     {
//         return $this->date ? $this->date->format('d/m/Y') : null;
//     }
// }
}