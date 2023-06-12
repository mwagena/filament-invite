<?php

namespace Concept7\FilamentInvite\Events;

use App\Models\User;

class InviteProcessedEvent
{
    public function __construct(public User $user, public string $password)
    {
        //
    }
}
