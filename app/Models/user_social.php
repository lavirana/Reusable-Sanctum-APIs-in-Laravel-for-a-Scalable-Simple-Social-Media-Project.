<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_social extends Model
{
    protected $table = 'user_social_links';

    protected $fillable = [
        'user_id',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'github',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}