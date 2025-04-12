<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // to kno which model we're dealing with
     protected $model = Post::class;


    public function definition(): array
    {
        return [
            // postId is generated automatically & it's auto-incremental
            // take an ID from UserFactory
            'user_id' => User::factory(),
            'title' => $this->faker->title(),
            'description' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now()->addDays(3)->toFormattedDateString(),
        ];
    }
}
