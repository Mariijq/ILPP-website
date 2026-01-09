<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CouncilMember extends Model
{
    use Searchable;
    protected $fillable = ['career_council_id', 'name', 'bio', 'image'];

    protected $casts = [
        'name' => 'array',
        'bio' => 'array',
    ];
    public function council()
    {
        return $this->belongsTo(CareerCouncil::class, 'career_council_id');
    }

}
