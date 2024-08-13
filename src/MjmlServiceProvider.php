<?php

namespace Maize\Mjml;

use Maize\Mjml\Commands\MjmlCommand;
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
            ->hasMigration('create_laravel_mjml_table')
            ->hasCommand(MjmlCommand::class);
    }
}
