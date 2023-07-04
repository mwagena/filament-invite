<?php

namespace Concept7\FilamentInvite\Http\Livewire;

use App\Models\User;
use Concept7\FilamentInvite\Events\InviteProcessedEvent;
use Concept7\FilamentInvite\Models\Invite;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;

class Accept extends Component implements HasForms
{
    use InteractsWithForms;
    use WithRateLimiting;

    public string $acceptId;

    public string $hash;

    public $submitted = false;

    public $expired = false;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(string $acceptId, string $hash): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->expired = ! Invite::query()
            ->where('id', $acceptId)
            ->where('token', $hash)
            ->where('expires_at', '>=', now())
            ->exists();

        $this->acceptId = $acceptId;
        $this->hash = $hash;

        $this->form->fill();
    }

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        if (! $this->expired) {
            return;
        }

        $data = $this->form->getState();

        $invite = Invite::query()
            ->where('id', $this->acceptId)
            ->where('token', $this->hash)
            ->where('email', $data['email'])
            ->where('expires_at', '>=', now())
            ->firstOrFail();

        $user = User::where('email', $data['email'])->first();

        $user->update([
            'password' => $data['password'],
            'email_verified_at' => now(),
        ]);

        $invite->delete();

        event(new InviteProcessedEvent($user, $data['password']));

        if (Auth::attempt($data)) {
            // $request->session()->regenerate();

            return redirect()->intended(route('filament.pages.dashboard'));
        }

        return route('filament.auth.login');

        $this->submitted = true;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label(__('Email'))
                ->email()
                ->required()
                ->autocomplete(),

            TextInput::make('password')
                ->label(__('Password'))
                ->password()
                ->required()
                ->rules([
                    Password::defaults(),
                ])
                ->confirmed(),

            TextInput::make('password_confirmation')
                ->label(__('Password confirmation'))
                ->password()
                ->required(),
        ];
    }

    public function render(): View
    {
        return view('filament-invite::accept')
            ->layout('filament::components.layouts.card', [
                'title' => __('Accept'),
            ]);
    }
}
