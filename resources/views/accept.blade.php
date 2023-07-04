<div>
    @unless($expired)
    <form wire:submit.prevent="submit" class="space-y-8">
        @if(session()->has('danger'))
            <div class="p-4 mb-4 text-sm text-danger-700 bg-danger-500/10 rounded-lg dark:bg-danger-900/50 dark:text-danger-700" role="alert">
                {{ session('danger') }}
            </div>
        @endif

        {{ $this->form }}

        <x-filament::button type="submit" form="submit" class="w-full">
            {{ __('Accept invite') }}
        </x-filament::button>

    </form>
    @else
        <p>{{ __('Invite link is expired.') }}</p>
    @endunless
</div>
