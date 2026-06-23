<?php

use Illuminate\Support\Facades\View;
use Maize\Mjml\ConversionMode;
use Maize\Mjml\Engines\MjmlEngine;
use Maize\Mjml\Tests\Fixtures\FakeConvert;

beforeEach(function () {
    FakeConvert::$lastValue = null;

    config()->set('mjml.mode', ConversionMode::Custom);
    config()->set('mjml.custom.action', FakeConvert::class);
});

it('resolves mjml views through the mjml engine', function () {
    expect(View::getEngineResolver()->resolve('mjml'))
        ->toBeInstanceOf(MjmlEngine::class);
});

it('compiles the blade template before passing it to the conversion action', function () {
    $output = view('sample', ['name' => 'Maize'])->render();

    expect($output)
        ->toContain('<!-- converted -->')
        ->toContain('Maize');

    expect(FakeConvert::$lastValue)
        ->toContain('Maize')
        ->not->toContain('{{ $name }}');
});
