<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $post;
    private $user;
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) //data from the form search works via $request
    {
        // $home_posts = [];

        if ($request->search) { //if home receive a search word
            $home_posts = $this->post->latest()
                ->where('description', 'LIKE', '%' . $request->search . '%')
                ->get();
            //SELECT......WHERE description LIKE '%searchword%'
        } else {
            //get list of all posts,ordered by latest
            $all_posts = $this->post->latest()->get();
            $home_posts = [];


            //filter home posts to only logged-users' OR posts by followed users
            foreach ($all_posts as $post) {
                if ($post->user_id == Auth::user()->id || $post->user->isFollowed()) {
                    $home_posts[] = $post;
                }
            }
        }

        return view('user.home')->with('all_posts', $home_posts) //$home_posts contains posts to show on home page
            ->with('suggested_users', $this->getSuggestedUsers())
            ->with('search', $request->search); //pass the search word back to the view
    }

    //get and return a list of users not followed yet(limit to 10)
    private function getSuggestedUsers()
    {
        //get a list all users
        $all_users = $this->user->all()->except(Auth::user()->id); //except logged in user
        //except(ID) - exclude rows with this ID

        $suggested_users = [];
        $count = 0;

        //loop through all users
        foreach ($all_users as $user) {
            //check if user is not already followed


            if (!$user->isFollowed() && $count < 10) { //if the user is already followed
                $suggested_users[] = $user;
                $count++;
            }

            if ($count >= 10) {
                return $suggested_users;
            }
        }

        return $suggested_users;
    }

    public function suggested()
    {
        //get a list all users except logged in user
        $all_users = $this->user->all()->except(Auth::user()->id); //except logged in user

        $suggested_users = [];
        $count = 0;

        //loop through all users
        foreach ($all_users as $user) {
            //check if user is not already followed
            // if (!$user->isFollowed() && $count < 10) { //if the user is already followed
            if ($count < 10) {
                $suggested_users[] = $user;
                $count++;
            }

            if ($count >= 10) {
                return view('user.suggested-users')->with('suggested_users', $suggested_users);
            }
        }

        return view('user.suggested-users')->with('suggested_users', $suggested_users);
    }
}
