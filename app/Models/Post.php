<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes; //to use soft deletes in posts table

    //post belongs to user
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed(); //relation to User.php
    }

    //post has category_posts(pivot table)
    public function categoryPosts()
    {
        return $this->hasMany(CategoryPost::class); //relation to CategoryPost.php
    }

    //post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //post has many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //return true if $this post is already liked
    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists(); //likes = function likes above and exists true
        //$this->likes()  =get all likes of this post
        //where(...)      =in the likes, find user_id = logged in user 
        //exists()        =if where() finds rows, return true
    }
}

//likes() look for logged in user if already liked this post