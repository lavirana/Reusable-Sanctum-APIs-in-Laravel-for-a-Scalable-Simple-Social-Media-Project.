<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cover_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(){
        return $this->hasMany(\App\Models\Post::class);
    }

    public function comments()
{
    return $this->hasMany(Comment::class);
}

public function followers(){

    // Users who are following this user
    return  $this->belongsToMany(User::class, 'user_followers', 'followed_id', 'follower_id')
    ->withPivot('follow_status')
    ->wherePivot('follow_status', 'followed')
    ->withTimestamps();
}


public function following(){
      // Users this user follows
      return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'followed_id')
      ->withPivot('follow_status')
      ->wherePivot('follow_status', 'followed')
      ->withTimestamps();
}


public function profileViews()
{
    return $this->hasMany(ProfileView::class, 'viewed_user_id');
}

public function socialLinks()
{
    return $this->hasOne(user_social::class);

}

}
