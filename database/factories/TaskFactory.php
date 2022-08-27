<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // fake task data
        return [
            'subject' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->date,
            'due_date' => $this->faker->date,
            'status' => $this->faker->randomElement(TaskStatus::getValues()),
            'priority' => $this->faker->randomElement(TaskPriority::getValues()),
        ];
    }
}
