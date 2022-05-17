<?php


use Faker\Generator as Faker;
use Farhadhp\SimpleTodo\Models\Label;
use Farhadhp\SimpleTodo\Tests\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
    ];
});
