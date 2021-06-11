<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Http\Controller\ApiController;
use App\Models\User;
use App\Notifications\NotifyController;
use Illuminate\Support\Facades\Mail;
use App\Mail\createdPost;

class PostsController extends Controller
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
        // $this->middleware('auth', ['except' => ['index', 'show']]);
        // must be a user with a verified email to create posts
        $this->middleware('verified', ['except' => ['index', 'show']]);

        $post = Post::latest()->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all posts
        //$posts = Post::all();

        // Fetch all posts in specific order - get is required when adding clauses (title, asc)
        //$posts = Post::orderBy('title', 'desc')->get();

        // Fetch all posts and paginate every 3 entries
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);

        // Return posts index view, assign fetched posts to template
        return view ('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Form validation
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            // cover image - must be an image, is optional and max 1999 because apache max is 2mb
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        // Has the user actually selected an image for upload?
        if($request->hasFile('cover_image')) {

            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename - standard php
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension - laravel
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            // Originalfilename_timeofposting.extension - prevents conflicting images
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload image
            // Create folder and store image(s)
            $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);

        } else {
            
            // redirect to default image if user does not submit image
            $fileNameToStore = 'noimage.jpg';
        }

        // Create post
        // started new Request object, making http request to API
        // create post, for every entry, the request is fetched and saved
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        // when creating, define the post writer
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        // email user, confirming post was created
        Mail::to(User::get('email'))->send(new createdPost());

        // if successful, message is returned to user
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        // return single post, assign to variable
        $post = Post::find($id);

        // returns template and passes variable to the template
        return view ('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if (auth()->user()->id !==$post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorised Page');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Form validation
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // Handle Image Update
        // Has the user actually selected an image for upload?
        if($request->hasFile('cover_image')) {

            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename - standard php
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension - laravel
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            // Originalfilename_timeofposting.extension - prevents conflicting images
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload image
            // Create folder and store image(s)
            $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);

        }

        // Update post
        // Same as create post except we find ID rather than create new
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        // if the update request has a cover image set, then replace / add new cover_image
        if($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check to ensure user is deleting their own post
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorised Page');
        }

        // Check to ensure when deleting post, that the default image does not get deleted
        if($post->cover_image != 'noimage.jpg') {
            // directory is the local, not the shortcut symbolic link
            Storage::delete('public/cover_image/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
