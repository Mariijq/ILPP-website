<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CareerCouncil extends Model
{
    use Searchable;
        protected $fillable = ['title','short_description', 'files'];

        protected $casts = [
            'title' => 'array',
            'short_description' => 'array',
            'files' => 'array',
        ];
    public function members()
    {
        return $this->hasMany(CouncilMember::class);
    }

}
