<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class FollowController extends Controller
{
    private $follow; //connect to follow table

    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }
    public function store($user_id) //same with route in web.php
    {
        $this->follow->follower_id = Auth::user()->id; //new empty row has follower_id =Auth::user()->id
        $this->follow->following_id = $user_id;
        $this->follow->save();

        return redirect()->back();
    }

    public function destroy($user_id)
    {
        $this->follow->where('follower_id', Auth::user()->id)->where('following_id', $user_id)->delete();

        return redirect()->back();
    }
}
