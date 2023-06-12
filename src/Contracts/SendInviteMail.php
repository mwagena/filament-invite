<?php

namespace Concept7\FilamentInvite\Contracts;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

interface SendInviteMail
{
    /**
     * @return Envelope
     */
    public function envelope();

    /**
     * @return Content
     */
    public function content();
}
