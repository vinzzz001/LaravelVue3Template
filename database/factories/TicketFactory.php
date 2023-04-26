<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => fake()->sentence(),
            "content" => fake()->text(),
            "category_id" => Category::factory(),
            "status_id" => random_int(1, 3),
            'user_id' => rand(1, (User::all()->count())),
            "assigned_to" => rand(1, (User::all()->count())),
            "updated_at" => fake()->dateTimeThisYear(),
        ];
    }
}
