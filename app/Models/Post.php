<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
public function comments()
{
    return $this->hasMany(Comment::class);
}


}
