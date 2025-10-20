<?php

namespace App\Http\Controllers\Admin; //unique namespace for admin controllers

use App\Http\Controllers\Controller; //unique namespace for admin controllers
use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // public function index()
    // {
    //list of all users, ordered by name
    // $all_users = $this->user->orderBy('name')->withTrashed()->paginate(10);
    //paginate(n) --get data means in page of n rows 10 users each page
    //withTrashed() --includes soft deleted rows in the data retrived
    //     return view('admin.users.index')->with('all_users', $all_users);
    // }

    public function index(Request $request)
    {
        if ($request->search) {
            $all_users = $this->user->orderBy('name')->withTrashed()
                ->where('name', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $all_users = $this->user->orderBy('name')->withTrashed()->paginate(10);
        }

        return view('admin.users.index')->with('all_users', $all_users)
            ->with('search', $request->search);
    }

    public function deactivate($id)
    {
        $this->user->destroy($id);

        return redirect()->back();
    }

    public function activate($id)
    {
        $this->user->onlyTrashed()->findOrFail($id)->restore(); //to find only soft deleted user's ID and restore

        return redirect()->back();
    }
}
