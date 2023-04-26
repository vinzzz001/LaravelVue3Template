<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Response>
 */
class ResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->realText(maxNbChars: 800, indexSize: 2),
            'user_id' => rand(1, (User::all()->count())),
            'ticket_id' => rand(1, (Ticket::all()->count())),
        ];
    }
}
