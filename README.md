# Laravel MJML

[![Latest Version on Packagist](https://img.shields.io/packagist/v/maize-tech/laravel-mjml.svg?style=flat-square)](https://packagist.org/packages/maize-tech/laravel-mjml)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/maize-tech/laravel-mjml/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/maize-tech/laravel-mjml/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/maize-tech/laravel-mjml/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/maize-tech/laravel-mjml/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/maize-tech/laravel-mjml.svg?style=flat-square)](https://packagist.org/packages/maize-tech/laravel-mjml)

Laravel MJML lets you write responsive HTML emails with [MJML](https://mjml.io/) directly inside your Blade templates. Any view named `*.mjml.blade.php` is first compiled by the Blade engine and then converted to production-ready, email-client-safe HTML, so you keep the full power of Blade (components, slots, directives, localization) while authoring with MJML's concise, responsive syntax.

The package registers a dedicated `mjml` view engine, ships a set of ready-to-use Blade email components and a notification-friendly `MailMessage`, and supports three conversion backends out of the box: a local Node renderer (default), the hosted MJML API, or your own custom action.

## Installation

You can install the package via composer:

```bash
composer require maize-tech/laravel-mjml
```

You can run the install command to publish the config file and views:

```bash
php artisan laravel-mjml:install
```

### Requirements

When using the default **Node** conversion mode, [MJML](https://github.com/mjmlio/mjml) must be available on the machine that renders the emails. You can install it globally with:

```bash
npm install -g mjml
```

If you cannot run Node on your environment, use the **API** conversion mode instead (see [Configuration](#configuration)).

## Configuration

This is the content of the published `config/mjml.php` file:

```php
use Maize\Mjml\Actions\APIConvert;
use Maize\Mjml\Actions\NodeConvert;
use Maize\Mjml\ConversionMode;

return [

    /*
     * The conversion mode used to convert MJML into HTML.
     * Available options: ConversionMode::Node, ConversionMode::API, ConversionMode::Custom
     */
    'mode' => ConversionMode::Node,

    'node' => [
        'action' => NodeConvert::class,

        // Options passed to the MJML renderer.
        // See https://github.com/mjmlio/mjml#inside-nodejs
        'options' => [
            'keepComments' => true,
            'ignoreIncludes' => false,
            'beautify' => false,
            'minify' => false,
        ],
    ],

    'api' => [
        'action' => APIConvert::class,

        // Basic auth credentials for the MJML API.
        'auth_user' => env('MJML_API_AUTH_USER'),
        'auth_password' => env('MJML_API_AUTH_PASSWORD'),
    ],

    'custom' => [
        'action' => null,
    ],

];
```

### Conversion modes

The `mode` option determines how MJML markup is turned into HTML.

#### Node (default)

Renders MJML locally through [`spatie/mjml-php`](https://github.com/spatie/mjml-php), which relies on the `mjml` Node binary. You can fine-tune the output through the `node.options` array — see the [MJML Node.js options](https://github.com/mjmlio/mjml#inside-nodejs) for the full list.

#### API

Sends the MJML markup to the hosted [MJML API](https://mjml.io/api) and returns the rendered HTML. It requires an account and the following environment variables:

```dotenv
MJML_API_AUTH_USER=your-application-id
MJML_API_AUTH_PASSWORD=your-secret-key
```

#### Custom

Set `mode` to `ConversionMode::Custom` and point `custom.action` to your own invokable class. The action receives the compiled MJML string and must return the rendered HTML:

```php
namespace App\Actions;

class MyConvert
{
    public function __invoke(string $value): string
    {
        // convert $value (MJML) into HTML and return it
    }
}
```

```php
// config/mjml.php
'mode' => ConversionMode::Custom,

'custom' => [
    'action' => \App\Actions\MyConvert::class,
],
```

## Usage

### Notifications

Use the package's `MailMessage` inside a notification's `toMail` method to render the notification with MJML instead of the default Laravel mail template. It extends Laravel's `MailMessage`, so the familiar fluent API (`greeting`, `line`, `action`, `salutation`, ...) keeps working:

```php
use Illuminate\Notifications\Notification;
use Maize\Mjml\MailMessage;

class OrderShipped extends Notification
{
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your order has shipped')
            ->greeting('Hello!')
            ->line('Your order is on its way.')
            ->action('Track your order', url('/orders/123'))
            ->line('Thank you for shopping with us!');
    }
}
```

### Custom MJML views

Any view whose name ends with `.mjml.blade.php` is automatically compiled by Blade and converted to HTML. You can use it like any other Blade view — for example as a mailable view:

```blade
{{-- resources/views/emails/welcome.mjml.blade.php --}}
<mjml>
    <mj-body>
        <mj-section>
            <mj-column>
                <mj-text>Welcome, {{ $name }}!</mj-text>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
```

```php
use Illuminate\Mail\Mailable;

class WelcomeMail extends Mailable
{
    public function __construct(public string $name)
    {
    }

    public function build(): self
    {
        return $this->view('emails.welcome', [
            'name' => $this->name,
        ]);
    }
}
```

### Blade components

When you publish the views, a set of `x-mjml::*` Blade components becomes available to help you build consistent, well-styled emails:

| Component | Description | Notable props |
| --- | --- | --- |
| `x-mjml::layout` | Full email scaffold with header, body, optional subcopy and footer slots. | — |
| `x-mjml::message` | Notification-style body: greeting, intro/outro lines, action button and salutation. | — |
| `x-mjml::header` | Top section rendering the application name (or the Laravel logo). | `url` |
| `x-mjml::footer` | Centered footer text (Markdown supported). | — |
| `x-mjml::button` | Call-to-action button. | `url`, `color` (default `#2d3748`), `align` (default `center`) |
| `x-mjml::line` | A line of text with Markdown parsing. | — |
| `x-mjml::panel` | Highlighted panel with a left border. | — |
| `x-mjml::subcopy` | Secondary text separated by a divider. | — |

Example:

```blade
<x-mjml::layout>
    <x-mjml::line>
        # Hello!

        Thanks for joining us.
    </x-mjml::line>

    <x-mjml::button url="https://example.com" color="#48bb78">
        Get started
    </x-mjml::button>
</x-mjml::layout>
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/maize-tech/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](https://github.com/maize-tech/.github/security/policy) on how to report security vulnerabilities.

> **Note on the API conversion mode:** when `ConversionMode::API` is enabled, the rendered email markup — which may contain personal data — is transmitted to the third-party `api.mjml.io` service. If your emails carry sensitive or personal information, prefer the local `ConversionMode::Node` to keep rendering in-house and minimize data sharing.

## Credits

- [Riccardo Dalla Via](https://github.com/riccardodallavia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
