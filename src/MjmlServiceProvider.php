<?php

namespace Maize\Mjml;

use Illuminate\Support\Facades\View;
use Maize\Mjml\Engines\MjmlEngine;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MjmlServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-mjml')
            ->hasConfigFile()
            ->hasViews()
            ->hasInstallCommand(
                fn (InstallCommand $command) => $command
                    ->publishConfigFile()
                    ->publish('views')
                    ->askToStarRepoOnGitHub('maize-tech/laravel-mjml')
            );
    }

    public function packageRegistered(): void
    {
        View::addExtension(
            extension: 'mjml.blade.php',
            engine: 'mjml',
            resolver: function () {
                $compiler = new MjmlEngine($this->app['blade.compiler'], $this->app['files']);

                $this->app->terminating(static function () use ($compiler) {
                    $compiler->forgetCompiledOrNotExpired();
                });

                return $compiler;
            }
        );
    }
}
