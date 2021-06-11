<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding Page.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        DB::table('pages')->delete();

        DB::table('pages')->insert(array (
            0 =>
                array (
                'template' => 'services',
                'name' => 'Services',
                'title' => 'Services',
                'slug' => 'services',
                'content' => '<p>This is the services page</p>',
                'extras' => '{"meta_title":null,"meta_description":null,"meta_keywords":null}'
                ),

            1 =>
                array (
                    'template' => 'about_us',
                    'name' => 'About',
                    'title' => 'About Us',
                    'slug' => 'about',
                    'content' => '<p>This is the about page</p>',
                    'extras' => '{"meta_title":null,"meta_description":null,"meta_keywords":null}'
                ),
        ));


        // Page::insert($pages);

        // return [
  
        // ];
    }
}
