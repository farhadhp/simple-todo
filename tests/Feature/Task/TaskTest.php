<?php

namespace Farhadhp\SimpleTodo\Tests\Feature\Task;


use Farhadhp\SimpleTodo\Models\Task;

use Farhadhp\SimpleTodo\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Farhadhp\SimpleTodo\Tests\User;

class TaskTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $userData;

    protected function setUp(): void
    {
        parent::setUp();

//        $this->userData = factory(User::class)->create([
//            'email' => $this->faker->safeEmail,
//        ]);

        $userData = factory(User::class)->create([
            'email' => $this->faker->safeEmail,
        ]);
//        dd($this->userData->id);
        $this->actingAs($userData);

//        $this->userData = $this->authentication();

    }

    public function testIndexMethodReturnsOk()
    {
        $userData = factory(User::class)->create([
            'email' => $this->faker->safeEmail,
        ]);

        $tasks = factory(Task::class)->create([
            'user_id' => $userData->id
        ]);

        $response = $this->withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $userData->token
        ])->get('api/simple-todo/v1/tasks');

        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'data' => [
//                '*' => [
//                    'id',
//                    'title',
//                    'description',
//                    'status' => [
//                        'id',
//                        'title'
//                    ],
//                    'labels' => [
//                        'id',
//                        'title',
//                        'tasks_count'
//                    ]
//                ]
//
//            ]
//        ]);
    }

    public function testStoreMethodReturnsOk()
    {
        $userData = factory(User::class)->create([
            'email' => $this->faker->safeEmail,
        ]);

        $task = [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(100),
            'labels' => [
                $this->faker->colorName(),
                $this->faker->firstName(),
                $this->faker->monthName(),
            ]
        ];

        $response = $this->withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $userData->token
        ])->postJson('api/simple-todo/v1/tasks', $task);

        unset($task['labels']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', $task);
    }

    public function testUpdateMethodReturnsOk()
    {
        $userData = factory(User::class)->create([
            'email' => $this->faker->safeEmail,
        ]);

        $task = factory(Task::class)->create([
            'user_id' => $userData->id
        ]);

        $item = [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(200)
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $userData->token
        ])->patchJson('api/simple-todo/v1/tasks/' . $task->id, $item);

        $this->assertDatabaseHas('tasks', $item);
        $response->assertStatus(200);
    }

    public function testRequiredFields()
    {
        $userData = factory(User::class)->create([
            'email' => $this->faker->safeEmail,
        ]);

        $task = [
//            'title' => $this->faker->name(), // Commented for test require fields
            'description' => $this->faker->text(100),
            'labels' => [
                $this->faker->colorName(),
                $this->faker->firstName(),
                $this->faker->monthName(),
            ]
        ];

        $response = $this->withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $userData->token
        ])->postJson('api/simple-todo/v1/tasks', $task);

        unset($task['labels']);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('tasks', $task);

    }

}
