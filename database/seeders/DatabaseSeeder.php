<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Separate call to the UserSeeder as to generate a specific test user.
        $this->call([
            UserSeeder::class,
        ]);


        \App\Models\User::factory(10)->create();
        \App\Models\Status::factory(3)->state(new Sequence(
            ['title' => 'todo'],
            ['title' => 'in progress'],
            ['title' => 'done'],
        ))->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Response::factory(10)->create();
        \App\Models\Ticket::factory(10)->create();

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
