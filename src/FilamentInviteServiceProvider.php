<?php

namespace Concept7\FilamentInvite;

use Concept7\FilamentInvite\Http\Livewire\Accept;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentInviteServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-invite';

    public function packageBooted(): void
    {
        Livewire::component('concept7.'.static::$name.'.pages.accept', Accept::class);
        parent::packageBooted();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web')
            ->hasMigration('2023_05_19_083051_create_invites_table')
            ->runsMigrations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp();
            });
    }
}
