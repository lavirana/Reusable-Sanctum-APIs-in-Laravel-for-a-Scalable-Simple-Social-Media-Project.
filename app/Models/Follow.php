<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'user_followers';
    
    Protected $fillable = [
        'follower_id',
        'followed_id',
        'follow_status',
    ];
}
