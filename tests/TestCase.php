<?php

namespace Farhadhp\SimpleTodo\Tests;

use Farhadhp\SimpleTodo\SimpleToDoServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Orchestra\Testbench\TestCase as TestCaseParent;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class TestCase extends TestCaseParent
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app
            ->make(EloquentFactory::class)
            ->load(__DIR__.'/../database/factories');


    }

    protected function getPackageProviders($app)
    {
        return [
            SimpleToDoServiceProvider::class,
        ];
    }

    public function authentication()
    {
        $user = factory(User::class)->create();
        $this->withToken($user->token);

        return $user;
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations(["--database" => "testbench"]);

        // call migrations specific to our tests, e.g. to seed the db
        // the path option should be an absolute path.
        $this->loadMigrationsFrom([
            "--database" => "testbench",
            "--path" => realpath(__DIR__ . "/../database/migrations"),
        ]);
    }

    protected function resolveApplicationCore($app)
    {
        parent::resolveApplicationCore($app);

        $app->detectEnvironment(function () {
            return "self-testing";
        });
    }

    protected function getEnvironmentSetUp($app)
    {
        $config = $app->get("config");

        $config->set("logging.default", "errorlog");
//        $config->set("uth.providers.users", [
//            'driver' => 'eloquent',
//            'model' =>  User::class,
//            'table' => 'users',
//        ]);

        $config->set("database.default", "testbench");

        $config->set("telescope.storage.database.connection", "testbench");

        $config->set("database.connections.testbench", [
            "driver" => "sqlite",
            "database" => ":memory:",
            "prefix" => "",
        ]);

//        config()->set('auth.providers.users', [
//            'driver' => 'eloquent',
//            'model' =>  User::class,
//            'table' => 'users',
//        ]);

        $app->when(DatabaseEntriesRepository::class)
            ->needs('$connection')
            ->give("testbench");
    }

    protected function createUser($attributes = [])
    {
        return factory(User::class)->create($attributes);
    }
}
