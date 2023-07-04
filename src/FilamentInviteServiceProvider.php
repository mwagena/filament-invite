<?php

namespace Concept7\FilamentInvite;

use Concept7\FilamentInvite\Http\Livewire\Accept;
use Filament\PluginServiceProvider;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;

class FilamentInviteServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-invite';

    protected array $resources = [
        // CustomResource::class,
    ];

    protected array $pages = [
        // CustomPage::class,
    ];

    protected array $widgets = [
        // CustomWidget::class,
    ];

    protected array $styles = [
        'plugin-filament-invite' => __DIR__.'/../resources/dist/filament-invite.css',
    ];

    protected array $scripts = [
        'plugin-filament-invite' => __DIR__.'/../resources/dist/filament-invite.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-invite' => __DIR__ . '/../resources/dist/filament-invite.js',
    // ];

    public function packageBooted(): void
    {
        parent::packageBooted();

        Livewire::component(Accept::getName(), Accept::class);
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web')
            ->hasMigration('2023_05_19_083051_create_invites_table')
            ->runsMigrations();
    }
}
