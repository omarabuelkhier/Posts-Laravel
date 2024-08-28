<?php

namespace Database\Factories;

use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'title' => fake()->unique()->word(),
            'description' => fake()->paragraph(1),
            'image' => fake()->image('public/images/posts', 150, 150, 'cats'),  // Creates a random cat image in the public/images/posts directory.
            'created_at' => fake()->dateTime(),
            // 'remember_token' => Str::random(10),

        ];
    }

    public function creator(){
        return $this->belongsTo(Creator::class);
    }

}
