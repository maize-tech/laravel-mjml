<?php

namespace Maize\Mjml;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Maize\Mjml\Commands\MjmlCommand;

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
