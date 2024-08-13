<?php

namespace Maize\Mjml;

use Illuminate\Support\Facades\View;
use Illuminate\View\DynamicComponent;
use Maize\Mjml\Compilers\MjmlCompiler;
use Maize\Mjml\Engines\MjmlEngine;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MjmlServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-mjml')
            ->hasConfigFile()
            ->hasViews('mail');
    }

    public function packageRegistered(): void
    {
        $this->registerMjmlCompiler();
        $this->registerMjmlResolver();

        View::addExtension('mjml.php', 'mjml');
    }

    protected function registerMjmlCompiler(): void
    {
        $this->app->singleton('mjml.compiler', function ($app) {
            return tap(new MjmlCompiler(
                $app['files'],
                $app['config']['view.compiled'],
                $app['config']->get('view.relative_hash', false) ? $app->basePath() : '',
                $app['config']->get('view.cache', true),
                $app['config']->get('view.compiled_extension', 'php'),
            ), function ($blade) {
                $blade->component('dynamic-component', DynamicComponent::class);
            });
        });
    }

    protected function registerMjmlResolver(): void
    {
        $this->app['view.engine.resolver']->register('mjml', function () {
            $compiler = new MjmlEngine($this->app['mjml.compiler'], $this->app['files']);

            $this->app->terminating(static function () use ($compiler) {
                $compiler->forgetCompiledOrNotExpired();
            });

            return $compiler;
        });
    }
}
