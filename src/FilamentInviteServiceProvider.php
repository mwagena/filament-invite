<?php

namespace Concept7\FilamentInvite;

use Concept7\FilamentInvite\Http\Livewire\Accept;
use Filament\Facades\Filament;
use Filament\Panel;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentInviteServiceProvider extends PackageServiceProvider
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
        // 'plugin-filament-invite' => __DIR__.'/../resources/dist/filament-invite.css',
    ];

    protected array $scripts = [
        // 'plugin-filament-invite' => __DIR__.'/../resources/dist/filament-invite.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-invite' => __DIR__ . '/../resources/dist/filament-invite.js',
    // ];

    public function register(): void
    {
        parent::register();

        Filament::registerPanel(
            $this->panel(Panel::make()),
        );
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        Livewire::component('accept', Accept::class);
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            // ->hasRoute('web')
            ->hasMigration('2023_05_19_083051_create_invites_table')
            ->runsMigrations();
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('invite')
            ->path('invite')
            ->pages([
                Accept::class,
            ]);
    }
}
