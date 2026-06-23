<?php

use Maize\Mjml\ConversionMode;

it('exposes the expected values', function () {
    expect(ConversionMode::Node->value)->toBe('node')
        ->and(ConversionMode::API->value)->toBe('api')
        ->and(ConversionMode::Custom->value)->toBe('custom');
});

it('resolves a case from its value', function () {
    expect(ConversionMode::from('node'))->toBe(ConversionMode::Node)
        ->and(ConversionMode::from('api'))->toBe(ConversionMode::API)
        ->and(ConversionMode::from('custom'))->toBe(ConversionMode::Custom);
});
