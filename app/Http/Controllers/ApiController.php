<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PostsController;
use App\Models\Post;

class ApiController extends Controller
{
    // get all posts in JSON format
    public function getAllPosts(Request $request) {
        // response code 200 = success
        $posts = Post::get()->toJson(JSON_PRETTY_PRINT);
        return response($posts, 200);
      }
  
      // create new post via POST request
      public function createPost(Request $request) {
        // started new Request object, making http request to API
        // create post, for every entry, the request is fetched and saved
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();

        // if successful, message is returned to user
        // response code 201 = success and data submitted
        return response()->json([
            "message" => "Post created!"
        ], 201);
      }
  
      // retrieve a post from db
      public function getPost($id) {
        // if submitted id matches an id in the db
        // retrieve the selected post and print in JSON
        if (Post::where('id', $id)->exists()) {
          $post = Post::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($post, 200);

        } else {
          // if matching post cannot be found, print 404
          return response()->json([
            "message" => "Post not found"
          ], 404);
        }
      }
  
      public function updatePost(Request $request, $id) {
        // first check to see if the post we want to edit exists
        if (Post::where('id', $id)->exists()) {
          $post = Post::find($id);

          // Ternary Method - works
          // $post->title = is_null($request->title) ? $post->title : $request->title;
          // $post->body = is_null($request->body) ? $post->body : $request->body;
          $post->user_id = is_null($request->user_id) ? $post->user_id : $request->user_id;

          // Modify title
          if (!empty($request->title)) {
            $post->title = $request->title;
          } else if (empty($request->title)) {
            $post->title = $post->title;
          }

          // Modify body
          if (!empty($request->body)) {
            $post->body = $request->body;
          } else if (empty($request->body)) {
            $post->body = $post->body;
          }

          $post->save();

          return response()->json([
            "message" => "Post Updated Successfully"
          ], 200);

        } else {

          return response()->json([
            "message" => "Post not found"
          ], 404);
        }
      }
  
      public function deletePost ($id) {
        if (Post::where('id', $id)->exists()) {
          // find post by ID and delete
          $post = Post::find($id);
          $post->delete();

          return response()->json([
            "message" => "Post Deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Post not found"
          ], 404);
        }
      }
}
