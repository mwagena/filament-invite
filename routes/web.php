<?php

use Concept7\FilamentInvite\Http\Livewire\Accept;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->prefix(config('filament.path'))
    ->name('filament.auth.')
    ->group(function () {
        Route::get('invite/accept/{acceptId}/{hash}', Accept::class)
            // ->middleware('signed')
            ->name('accept-invite');
    });
