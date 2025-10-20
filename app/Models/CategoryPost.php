<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    public $timestamps = false; //no timestamps columns; do not save timestamps
    protected $table = 'category_post'; //actual name of table; if table name is not plural of model name for pivot table
    protected $fillable = ['post_id', 'category_id']; //used in create() or createmany() 

    //category_post(pivot table) belongs to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //category_post(pivot table) belongs to post
    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    

}
