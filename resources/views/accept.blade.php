<x-filament-panels::page.simple>

@unless($expired)
<x-filament-panels::form wire:submit="submit">
    {{ $this->form }}

    <x-filament-panels::form.actions
        :actions="$this->getCachedFormActions()"
        :full-width="$this->hasFullWidthFormActions()"
    />
</x-filament-panels::form>
@else
<p>{{ __('Invite link is expired.') }}</p>
@endunless

</x-filament-panels::page.simple>

