<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false; // we don't need timestamps for likes
    //like belongs to user
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed(); //relation to User and Post.php
    }
}
