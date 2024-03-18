<?php

use Concept7\FilamentInvite\Http\Livewire\Accept;
use Filament\Facades\Filament;

Route::name('filament.')->group(function () {
    foreach (Filament::getPanels() as $panel) {
        $domains = $panel->getDomains();

        foreach ((empty($domains) ? [null] : $domains) as $domain) {
            Route::domain($domain)
                ->middleware($panel->getMiddleware())
                ->name($panel->getId().'.')
                ->prefix($panel->getPath())
                ->group(function () {
                    Route::get('invite/accept/{acceptId}/{hash}', Accept::class)
                        ->name('accept-invite');
                });
        }
    }
});
