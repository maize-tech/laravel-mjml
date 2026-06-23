<?php

use Illuminate\Support\Facades\Http;
use Maize\Mjml\Actions\APIConvert;
use Maize\Mjml\ConversionMode;

beforeEach(function () {
    config()->set('mjml.mode', ConversionMode::API);
    config()->set('mjml.api.auth_user', 'user');
    config()->set('mjml.api.auth_password', 'secret');
});

it('converts mjml to html through the api', function () {
    Http::fake([
        'api.mjml.io/*' => Http::response(['html' => '<html>ok</html>']),
    ]);

    $html = app(APIConvert::class)('<mjml></mjml>');

    expect($html)->toBe('<html>ok</html>');
});

it('sends the mjml payload with basic auth to the render endpoint', function () {
    Http::fake([
        'api.mjml.io/*' => Http::response(['html' => '<html>ok</html>']),
    ]);

    app(APIConvert::class)('<mjml></mjml>');

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.mjml.io/v1/render'
            && $request['mjml'] === '<mjml></mjml>'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('user:secret'));
    });
});
