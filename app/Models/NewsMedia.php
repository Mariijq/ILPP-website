<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class NewsMedia extends Model
{
    use Searchable;

    protected $fillable = ['news_id', 'type', 'path'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
