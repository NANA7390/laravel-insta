<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post; //$this->post=new Post; and connection to Post model
    }

    public function create()
    {
        // $categories = new Category;
        // $this->category = new Category;
        // $all_categories = $this->category->all();

        $all_categories = Category::all();

        return view('user.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'categories' => 'required|array|between:1,3', //items in array between 1 and 3items
            'description' => 'required|max:1000',
            'image' => 'required|max:1048|mimes:jpg,jpeg,png,gif'

        ]);

        $this->post->description = $request->description;
        $this->post->user_id = Auth::user()->id; //logged in user id
        $this->post->image = "data:image/" . $request->image->extension() . ";base64," . base64_encode(file_get_contents($request->image));

        $this->post->save();  //get id after save

        //save category_posts  (post table and category table in category_post)
        $category_posts = []; //empty array

        foreach ($request->categories as $category_id) { //create.blade.php 参照
            $category_posts[] = ['category_id' => $category_id]; //insert into array = $category_posts[]

            //alternative way without using createMany()
            // CategoryPost::create([
            //     'category_id' => $category_id,//insert ids into category_post table
            //     'post_id' => $this->post->id

            // ]);
        }

        // $category_post = [
        //     ['category_id' => 1,],
        //     ['post_id' => 2,]
        // ];

        $this->post->categoryPosts()->createMany($category_posts); //array insert into category_post table and it goes to $this->post->id
        //call categoryPosts() in Post.php $this->post(id) has connection to category_post table(no data) and createMany with( data array)
        return redirect()->route('home');
    }

    public function show($id)
    {
        //get row of post with ID=$id
        $post = $this->post->findOrFail($id);

        return view('user.posts.show')->with('post', $post); //folder and file name with data
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id) {
            return redirect()->route('post.show', $id);
        }
        $all_categories = Category::all();

        //get a list of selected category ids
        $selected_categories = []; //empty array
        foreach ($post->categoryPosts as $category_post) { //id found line80 and post has it
            $selected_categories[] = $category_post->category_id;
        }

        return view('user.posts.edit')
            ->with('all_categories', $all_categories)
            ->with('post', $post)
            ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categories' => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image' => 'max:1048|mimes:jpg,jpeg,png,gif' //not required

        ]);
        $post = Post::findOrFail($id);

        $post->description = $request->description;
        //check if form has new image
        if ($request->image) {
            $post->image = "data:image/" . $request->image->extension() . ";base64," . base64_encode(file_get_contents($request->image));
        }
        $post->save();

        //update category_posts
        $post->categoryPosts()->delete();

        $category_posts = []; //empty array
        foreach ($request->categories as $category_id) {
            $category_posts[] = ['category_id' => $category_id];
        }

        $post->categoryPosts()->createMany($category_posts); //Post.phpのcategoryPosts()を呼び出し、category_postテーブルにデータを挿入

        return redirect()->route('post.show', $id);
    }


    public function destroy($id)
    {
        // $this->post->destroy($id);
        $this->post->findOrFail($id)->forceDelete(); //permanently delete   

        return redirect()->route('home');
    }
}
