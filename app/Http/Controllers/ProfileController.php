<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        //get user where ID=$id

        $user = $this->user->findOrFail($id);

        return view('user.profiles.show')->with('user', $user);
    }

    public function edit()
    {
        return view('user.profiles.edit');
    }

    public function update(Request $request) //no need id because already logged in
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'avatar' => 'max:1048|mimes:jpg,jpeg,png,gif',
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            //UPDATE: unique:<table>,<column>,<id of updated row>
            //ADDING: unique:<table>,<column>
            'introduction' => 'max:100'
        ]);

        $user = $this->user->findOrFail($request->id); //get user by id
        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        //check if form has new avatar
        if ($request->avatar) {
            $user->avatar = "data:avatar/" . $request->avatar->extension() . ";base64," . base64_encode(file_get_contents($request->avatar));
        }
        $user->save();

        return view('user.profiles.show')->with('user', Auth::user());
    }

    public function followers($id)
    {
        $user = $this->user->findOrFail($id);

        return view('user.profiles.followers')->with('user', $user); //give the data from views
    }

    public function following($id)
    {
        $user = $this->user->findOrFail($id);

        return view('user.profiles.following')->with('user', $user); //give the data from views
    }

    public function updatePassword(Request $request)
    {
        //validate: current/old password is incorrect
        $user = $this->user->findOrFail(Auth::user()->id); //find user to check current password(hash code)
        if (!Hash::check($request->old_password, $user->password)) { //check hash old password and then if not match current pw ,show error message
            return redirect()->back()->with('current_password_error', 'That is not your current password. Please try again.'); //variable name and the value
        }

        //validate: new password is the same as current password
        if ($request->old_password == $request->new_password) { //if data has problem, redirect back with error message(valiable name and the value)
            return redirect()->back()->with('same_password_error', 'New password must be different from current password.');
        }

        //validate:match new password confirmation
        $request->validate([
            'new_password' => 'required|min:8|confirmed', //confirmed means it must match with new_password_confirmation
            //confirmed => needs 2 inputs named "X" and "X_confirmation"
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('password_success', 'Password successfully changed!');
    }

    // public function suggested()
    // {
    //     //get a list all users except logged in user
    //     $all_users = $this->user->all()->except(Auth::user()->id); //except logged in user

    //     $suggested_users = [];
    //     $count = 0;

    //     //loop through all users
    //     foreach ($all_users as $user) {
    //         //check if user is not already followed
    //         if (!$user->isFollowed() && $count < 10) { //if the user is already followed
    //             $suggested_users[] = $user;
    //             $count++;
    //         }

    //         if ($count >= 10) {
    //             return view('user.suggested-users')->with('suggested_users', $suggested_users);
    //         }

    //         if ($user->isFollowed($id)) {


    //     return view('user.suggested-users')->with('user', $user); //give the data from views
    //     ->with('followed', 'Follows you');
    //     else{
    //         return view('user.suggested-users')->with('user', $user); //give the data from views
    //     return view('user.suggested-users')->with('user', $user); //give the data from views
    //     ->with('not_followed', 'No followers yet' || count($user->followers) . ' followers');
    //     }

    //     }

    //     return view('user.suggested-users')->with('suggested_users', $suggested_users);
    // }
}
