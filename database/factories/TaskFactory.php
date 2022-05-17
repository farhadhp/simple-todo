<?php


use Faker\Generator as Faker;
use Farhadhp\SimpleTodo\Models\Task;
use Farhadhp\SimpleTodo\Tests\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->text(200),
        'status' => Arr::random(Task::ALL_STATUS),
        'user_id' => factory(User::class)->create()->id,
    ];
});
