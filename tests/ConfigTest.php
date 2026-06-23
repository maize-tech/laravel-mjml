<?php

use Maize\Mjml\Actions\APIConvert;
use Maize\Mjml\Actions\NodeConvert;
use Maize\Mjml\ConversionMode;
use Maize\Mjml\Support\Config;

it('returns the node conversion mode by default', function () {
    expect(Config::getConversionMode())->toBe(ConversionMode::Node);
});

it('returns the conversion mode set in config', function () {
    config()->set('mjml.mode', ConversionMode::API);

    expect(Config::getConversionMode())->toBe(ConversionMode::API);
});

it('resolves the conversion action for the current mode', function () {
    expect(Config::getConversionAction())->toBe(NodeConvert::class);

    config()->set('mjml.mode', ConversionMode::API);

    expect(Config::getConversionAction())->toBe(APIConvert::class);
});

it('throws when the conversion action is not configured', function () {
    config()->set('mjml.mode', ConversionMode::Custom);

    expect(fn () => Config::getConversionAction())->toThrow(Exception::class);
});

it('returns the params of the current conversion mode', function () {
    expect(Config::getConversionParams())
        ->toBeArray()
        ->toHaveKey('action', NodeConvert::class)
        ->toHaveKey('options');
});

it('returns a single conversion param by key', function () {
    expect(Config::getConversionParam('options'))
        ->toBeArray()
        ->toHaveKey('keepComments', true);
});

it('returns null for a missing conversion param', function () {
    expect(Config::getConversionParam('missing'))->toBeNull();
});
