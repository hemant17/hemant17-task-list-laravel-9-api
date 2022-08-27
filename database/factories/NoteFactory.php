<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // fake note data with multiple attachments
        return [
            'subject' => $this->faker->sentence,
            'attachment' => [
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
                'https://picsum.photos/200/300',
            ],
            'note' => $this->faker->paragraph,
        ];
    }
}
