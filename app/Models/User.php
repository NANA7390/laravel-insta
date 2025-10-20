<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    //user has many posts
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    //user has many users
    public function follows()
    {
        return $this->hasMany(Follow::class, 'follower_id'); //relation to Follower.php
    }

    //user has many followers
    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id'); //relation to Follower.php
    }

    //return true if the user is already followed (by logged-in user)
    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        //$this->followers() = find all the user's followers
        //where(...)         =in the followers, find the logged-in user(using follower_id = Auth::user()->id)
        //exists()           =return true if found
        //$this is user.get lists of followers and check if the follower_id is the logged-in user id
    }

    //return true if this user follows the logged-in user
    public function isFollowing($user_id)
    {
        return $this->follows()->where('following_id', $user_id)->exists();
    }
}
