<?php

namespace Maize\Mjml\Engines;

use Illuminate\View\Engines\CompilerEngine;
use Spatie\Mjml\Mjml;

class MjmlEngine extends CompilerEngine
{
    public function get($path, array $data = []): string
    {
        $value = parent::get($path, $data);
        $mjml = Mjml::new();

        if ($mjml->canConvert($value)) {
            return $mjml->minify()->toHtml($value);
        }

        return $value;
    }
}
