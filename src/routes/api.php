<?php

use Farhadhp\SimpleTodo\Http\Controllers\Api\V1\LabelController;
use Farhadhp\SimpleTodo\Http\Controllers\Api\V1\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/v1/tasks', TaskController::class)->except('destroy');
Route::apiResource('/v1/labels', LabelController::class)->only('index');
