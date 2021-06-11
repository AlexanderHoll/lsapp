<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\PostsController;

use App\Models\User;
use App\Models\Post;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // middleware auth locks page away for anyone who isn't logged in
    // i.e must be authenticated to view page
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // fetch logged in user ID
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        // return the dashboard view with the posts by the fetched user
        return view('home')->with('posts', $user->posts);
    }
}
