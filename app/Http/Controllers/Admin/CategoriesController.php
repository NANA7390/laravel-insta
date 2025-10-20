<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        //list of all categories, ordered by name
        $all_categories = $this->category->latest()->paginate(10);
        //paginate(n) --get data means in page of n rows 10 categories each page
        //withTrashed() --includes soft deleted rows in the data retrived

        //count # of posts without categories
        $all_posts = Post::all(); //get all posts
        $count = 0;
        foreach ($all_posts as $post) {
            if ($post->categoryPosts->count() == 0) { //if post has no categories
                $count++;
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)
            ->with('uncategorized_count', $count);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name'
        ]);

        $this->category->name = ucwords($request->name); //ucwords() --capitalize first letter of each word
        $this->category->save();

        return redirect()->route('admin.categories');
    }

    public function destroy($id)
    {
        $this->category->destroy($id);

        return redirect()->route('admin.categories');
    }

    // public function update(Request $request, Category $category)
    // {
    //     $request->validate(
    //         [
    //             'name' => 'required|max:50|unique:categories,name,' . $category->id
    //         ],
    //         [
    //             // Custom error messages
    //             'name.' . $category->name .  '.required' => 'The category name is required.',
    //             'name.' . $category->name .  '.max' => 'The category name must not exceed 50 characters.',
    //             'name.' . $category->name .  '.unique' => 'This category name has already been taken.',

    //         ]
    //     );

    //     $category = $this->category->findOrFail($request->id);
    //     $category->name = ucwords($request->name);

    //     $category->name = $request->name; //added
    //     $category->save();

    //     return redirect()->route('admin.categories'); //added
    // }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                "categ_name$id" => 'required|max:50|unique:categories,name,' . $id
            ],
            [
                "categ_name$id.required" => 'Name is required.',
                "categ_name$id.max"     => 'Maximum of 50 characters only',
                "categ_name$id.unique"  => 'This name already exists.'
            ]
        );

        $categ = $this->category->findOrFail($id);
        $categ->name = ucwords($request->input("categ_name$id"));
        $categ->save();

        return redirect()->route('admin.categories');
    }
}
