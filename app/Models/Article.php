<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[ObservedBy(\App\Observers\ArticleObserver::class)]
class Article extends Model
{
    protected $fillable = [
        'title','slug','body','user_id','status','views','featured'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($article) {
            $slug = Str::slug($article->title);
            $count = Article::where('slug', 'LIKE', "{$slug}%")->count();
            $article->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}

