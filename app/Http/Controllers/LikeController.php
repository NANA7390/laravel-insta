<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function store($post_id)
    {
        $this->like->user_id = Auth::user()->id;
        $this->like->post_id = $post_id;
        $this->like->save();

        return redirect()->back();
    }

    public function destroy($post_id)
    {
        $this->like->where('user_id', Auth::user()->id)
            ->where('post_id', $post_id)
            ->delete(); //admin has only post_id and user_id for likes so we can use where(look for rows of logged in user and the valid post_id)->delete()

        return redirect()->back();
    }
}
