<?php

namespace Maize\Mjml\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Maize\Mjml\MjmlServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Maize\\Mjml\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->app['view']->addLocation(__DIR__.'/Fixtures/views');
    }

    protected function getPackageProviders($app)
    {
        return [
            MjmlServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
