<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post; //$this->post = new Post
    }

    // public function index()
    // {
    //     $all_posts = $this->post->latest()->withTrashed()->paginate(10);

    //     return view('admin.posts.index')->with('all_posts', $all_posts);
    // }


    // public function index(Request $request) //data from the form search works via $request
    // {
    //     // $home_posts = [];

    //     if ($request->search_description) { //if home receive a search word
    //         $all_posts = $this->post->latest()->withTrashed()
    //             ->where('description', 'LIKE', '%' . $request->search_description . '%')
    //             ->paginate(10);
    //         //SELECT......WHERE description LIKE '%searchword%'
    //     } else {
    //         //get list of all posts,ordered by latest
    //         $all_posts = $this->post->latest()->withTrashed()->paginate(10);
    //         $all_posts = [];


    //         //filter all posts to only logged-users' OR posts by followed users
    //         foreach ($all_posts as $post) {
    //             if ($post->user_id == Auth::user()->id || $post->user->isFollowed()) {
    //                 $all_posts[] = $post;
    //             }
    //         }
    //     }

    //     return view('admin.posts.index')->with('all_posts', $all_posts) //$all_posts contains posts to show on home page
    //         // ->with('suggested_users', $this->getSuggestedUsers())
    //         ->with('search_description', $request->search_description); //pass the search word back to the view
    // }

    public function index(Request $request)
    {
        if ($request->search) {
            $all_posts = $this->post->latest()->withTrashed()
                ->where('description', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $all_posts = $this->post->latest()->withTrashed()->paginate(10);
        }

        return view('admin.posts.index')->with('all_posts', $all_posts)
            ->with('search', $request->search);
    }






    public function hide($id)
    {
        $this->post->destroy($id);

        return redirect()->back();
    }

    public function unhide($id)
    {
        $this->post->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
}
