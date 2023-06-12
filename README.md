# Handles invites so setup your users' passwords.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/concept7/filament-invite.svg?style=flat-square)](https://packagist.org/packages/concept7/filament-invite)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/concept7/filament-invite/run-tests?label=tests)](https://github.com/concept7/filament-invite/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/concept7/filament-invite/Check%20&%20fix%20styling?label=code%20style)](https://github.com/concept7/filament-invite/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/concept7/filament-invite.svg?style=flat-square)](https://packagist.org/packages/concept7/filament-invite)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require concept7/filament-invite
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

- [Martijn Wagena](https://github.com/concept7)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
