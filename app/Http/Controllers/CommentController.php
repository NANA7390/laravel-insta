<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment; //$this->comment=new Comment; and connection to Comment model
    }

    public function store(Request $request, $post_id)
    {
        $request->validate([
            "comment_body$post_id" => 'required|max:150' //create.blade.php form action""参照
        ], [
            "comment_body$post_id.required" => "You cannot post an empty comment.",
            "comment_body$post_id.max" => "Maximum of 150 characters only."
        ]);

        $this->comment->body = $request->input("comment_body$post_id"); //create.blade.php 参照
        $this->comment->user_id = Auth::id(); //logged in user id
        $this->comment->post_id = $post_id; //which post adds the comment 


        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
