<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TasCreatedTest extends TestCase
{
    public function task()
    {
        return [
            'subject' => 'test subject',
            'description' => 'test description',
            'start_date' => '05-05-2021',
            'due_date' => '15-05-2021',
            'status' => 'New',
            'priority' => 'Low',
            'notes' => [
                [
                    'subject' => 'test subject',
                    'attachment' => [
                        UploadedFile::fake()->create('test.jpg', 100),
                    ],
                    'note' => 'test note',
                ],
            ],
        ];
    }

    // unauthented user can not create task
    public function test_unauthented_user_can_not_create_task()
    {
        $response = $this->post('api/v1/tasks', $this->task());
        $response->assertStatus(302);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_task_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // create php unit test to task created api endpoint /api/v1/tasks
        $response = $this->post('/api/v1/tasks', $this->task());
        $response->assertStatus(201);
    }

    public function test_delete_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create();
        $response = $this->delete('/api/v1/tasks/'.$task->id);
        $response->assertStatus(200);
    }
}
