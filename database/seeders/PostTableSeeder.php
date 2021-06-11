<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use database\factories\PostFactory;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('posts')->delete();
    //     $json = file_get_contents(database_path() . "/data/test.json");
        
    //     $data = json_decode($json);
    //     foreach ($data as $obj) {
    //         //Post::create(array(
    //         Post::updateOrCreate(array(
    //             'user_id' => $obj->user_id,
    //             'title' => $obj->title,
    //             'body' => $obj->body,
    //             'cover_image' => $obj->cover_image
    //         ));
    //     }
    // }

    // public function run() {
    //     $count = 10;
    //     factory(Post::class, $count)->create();
    // }

    public function run() {
        Post::factory()->count(10)->create();
    }
}
