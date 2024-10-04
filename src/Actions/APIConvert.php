<?php

namespace Maize\Mjml\Actions;

use Illuminate\Support\Facades\Http;
use Maize\Mjml\Support\Config;

class APIConvert
{
    public function __invoke(string $value): string
    {
        return Http::withBasicAuth(
            username: Config::getConversionParam('auth_user'),
            password: Config::getConversionParam('auth_password'),
        )->post('https://api.mjml.io/v1/render', [
            'mjml' => $value,
        ])->json('html');
    }
}
