<?php

namespace Concept7\FilamentInvite\Jobs;

use App\Models\User;
use Concept7\FilamentInvite\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Str;

class SendInvite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User $user
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $invite = Invite::create([
            'email' => $this->user->email,
            'token' => Str::random(10),
            'expires_at' => now()->addHours(config('filament-invite.expiration_time_in_hours')),
        ]);

        $this->user->sendInviteNotification($invite);
    }
}
