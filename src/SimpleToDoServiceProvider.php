<?php

namespace Farhadhp\SimpleTodo;

use Farhadhp\SimpleTodo\Http\Middleware\UserTokenAuthorize;
use Farhadhp\SimpleTodo\Models\Task;
use Farhadhp\SimpleTodo\Observers\TaskObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SimpleToDoServiceProvider extends ServiceProvider
{
    private $routesPath = __DIR__ . '/routes/api.php';
    private $migrationsPath = __DIR__ . "/../database/migrations";
    private $configPath = __DIR__ . "/../config/simple_todo.php";
    private $langPath = __DIR__ . "/resources/lang/en/task.php";

    public function boot()
    {
        $this->loadMigrationsFrom($this->migrationsPath);
        $this->registerRoutes();
//        $this->loadRoutesFrom($this->routesPath);
        Task::observe(TaskObserver::class);
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    $this->migrationsPath => database_path('migrations')
                ],
                'simple_todo_migrations'
            );

            $this->publishes(
                [
                    $this->configPath => config_path('simple_todo.php'),
                ],
                'simple_todo_config'
            );

            $this->publishes(
                [
                    $this->langPath => resource_path('lang/en/task.php'),
                ],
                'simple_todo_lang'
            );
        }
    }

    private function registerRoutes()
    {
        Route::middlewareGroup("simple_todo_api_auth", config("simple_todo.middleware", [
            'api' => UserTokenAuthorize::class
        ]));

        Route::group(
            [
                'prefix' => 'api/simple-todo',
                'middleware' => 'simple_todo_api_auth'
            ],
            function () {
                $this->loadRoutesFrom($this->routesPath);
            }
        );
    }
}
