<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class PostFactory extends Factory
{

    use RefreshDatabase;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;
    

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // prevent faker from fetching 0 as user ID - should fetch based off of available users
            //'user_id' => $this->faker->randomDigitNot(0),
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            // ensure image fetched is formatted as needed
            //'cover_image' => $this->faker->imageUrl($width = 400, $height = 300),
            // 'cover_image' => $this->faker->image('public/storage/cover_image', 400, 300, null, false),
            'cover_image' => 'noimage.jpg',
        ];
    }
}
