<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class EditController extends Controller
{

    public function edit(Request $request)
    {
        $post = Post::find($request->id);
        $all_categories = Category::all();

        return view('user.posts.edit')
            ->with('all_categories', $all_categories)->with('post', $post);
    }
}
