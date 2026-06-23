<?php

use Maize\Mjml\Actions\NodeConvert;
use Maize\Mjml\ConversionMode;

it('converts mjml to html through node', function () {
    config()->set('mjml.mode', ConversionMode::Node);

    $mjml = <<<'MJML'
    <mjml>
        <mj-body>
            <mj-section>
                <mj-column>
                    <mj-text>Hello Maize</mj-text>
                </mj-column>
            </mj-section>
        </mj-body>
    </mjml>
    MJML;

    try {
        $html = app(NodeConvert::class)($mjml);
    } catch (Throwable $e) {
        test()->markTestSkipped('Node.js and the mjml package are not available: '.$e->getMessage());
    }

    expect($html)
        ->toContain('<html')
        ->toContain('Hello Maize');
});
