<?php

namespace Maize\Mjml\Actions;

use Maize\Mjml\Support\Config;
use Spatie\Mjml\Mjml;

class NodeConvert
{
    public function __invoke(string $value): string
    {
        return Mjml::new()->toHtml(
            mjml: $value,
            options: Config::getConversionParam('options'),
        );
    }
}
