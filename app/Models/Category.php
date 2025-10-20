<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    //category has many category_posts(pivot table)
    public function categoryPosts()
    {
        return $this->hasMany(CategoryPost::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }
}
