<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use Laravel\Scout\Searchable;

class Slide extends Model
{
    use Searchable;
    protected $fillable = ['news_id', 'title', 'subtitle', 'date', 'image', 'order'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
