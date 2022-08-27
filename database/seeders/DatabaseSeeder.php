<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // create task with notes factory
        \App\Models\Task::factory()
            ->has(\App\Models\Note::factory()->count(3))
            ->count(10)
            ->create();

        // create users factory
        \App\Models\User::factory()->count(10)->create();
    }
}
