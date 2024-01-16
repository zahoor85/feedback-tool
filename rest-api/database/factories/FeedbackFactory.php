<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status  = $this->faker->randomElement(["draft", "published"]);
        $comment = $this->faker->randomElement([true, false]);
        return [
            "title" => $this->faker->name(),
            "description" =>  $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "category_id" => Category::factory(),
            "user_id" => User::factory(),
            "status" => $status,
            "is_comment" => $comment

        ];
    }
}
