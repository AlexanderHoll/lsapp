<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BasicSeed;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class BasicTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add entries to db
        DB::table('basic_seeds')->delete();
        $json = file_get_contents(database_path() . "/data/test.json");
        
        $data = json_decode($json);
        foreach ($data as $obj) {
            BasicSeed::create(array(
                'title' => $obj->title,
                'body' => $obj->body,
                'cover_image' => $obj->cover_image
            ));
        }
    }
}
