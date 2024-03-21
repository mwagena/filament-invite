# Handles invites so setup your users' passwords.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/concept7/filament-invite.svg?style=flat-square)](https://packagist.org/packages/concept7/filament-invite)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/concept7/filament-invite/run-tests?label=tests)](https://github.com/concept7/filament-invite/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/concept7/filament-invite/Check%20&%20fix%20styling?label=code%20style)](https://github.com/concept7/filament-invite/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/concept7/filament-invite.svg?style=flat-square)](https://packagist.org/packages/concept7/filament-invite)

The package will be sending out invite emails by listening to the 'created'-event on user model. The user can click a link in the email to setup their password.
Also included is a expired check on the link.
The link will be as following: `domain.tld/invite/accept?acceptId=<uuid>&hash=<hash>`

## Installation

You can install the package via composer:

```bash
composer require concept7/filament-invite
```

Register the plugin in your panel provider:

```php
use Concept7\FilamentInvite\InvitePlugin;

public function panel(Panel $panel): Panel
{
    return $panel
       ->plugin(new InvitePlugin());
}
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-invite-migrations"
php artisan migrate
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-invite-views"
```

## Usage

### Add Invitable trait to User model

```php
use Concept7\FilamentInvite\Models\Traits\Invitable;
```

### Create a mailable

In app/Mail, create SendInviteMail.php, e.g.

```
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Concept7\FilamentInvite\Contracts\SendInviteMail as SendInviteMailContract;

class SendInviteMail extends Mailable implements SendInviteMailContract
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
    /**
     * Create a new message instance.
     */
    public function __construct(
        private User $user,
        private $url
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->user->email,
            subject: 'You are invited to join ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'filament-invite::mail.invite',
            with: [
                'user' => $this->user,
                'link' => $this->url,
            ]
        );
    }
}
```

### Configuration

By default, your users need to input their _current_ e-mail address when accepting an invitation. This is an extra security layer, so when the invitation link gets stolen, one needs to know the e-mail address that is being activated. To disable this behavior, set in `config/filament-invite.php`:

```php
    'require_current_email_on_invite' => false,
```

### Event listener

If for some reason you need to listen to the InviteAccepted Event, you can register a listener handling a InviteProcessedEvent.
Register the listener in your EventServiceProvider.

```php
InviteProcessedEvent::class => [
    InviteProcessedListener::class,
]
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Martijn Wagena](https://github.com/concept7)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
