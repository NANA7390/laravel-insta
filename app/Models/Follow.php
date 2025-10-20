<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $timestamps = false; //no use created_at, updated_at

    //follow belongs to user(paired with follower())
    public function following()
    {
        return $this->belongsTo(User::class, 'following_id')->withTrashed(); //relation to User.php
    }

    //follow belongs to user(paired with follows())
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id')->withTrashed(); //relation to User.php
    }
}
