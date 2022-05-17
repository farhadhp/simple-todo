<?php

namespace Farhadhp\SimpleTodo\Tests\Feature\Task;


use Farhadhp\SimpleTodo\Models\Label;
use Farhadhp\SimpleTodo\Models\Task;

use Farhadhp\SimpleTodo\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Farhadhp\SimpleTodo\Tests\User;

class LabelTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testIndexMethodReturnsOk()
    {
        $userData = factory(User::class)->create([
            'email' => $this->faker->safeEmail,
        ]);

        $labels = factory(Label::class)->create(10);

        $response = $this->withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $userData->token
        ])->get('api/simple-todo/v1/labels');

        $response->assertStatus(200);
    }

}
