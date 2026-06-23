<?php

use Illuminate\Support\Facades\View;
use Maize\Mjml\ConversionMode;

it('registers the mjml blade extension', function () {
    expect(View::getExtensions())->toHaveKey('mjml.blade.php', 'mjml');
});

it('loads the package config file', function () {
    expect(config('mjml'))->toBeArray()
        ->and(config('mjml.mode'))->toBe(ConversionMode::Node);
});
