<?php

namespace Maize\Mjml\Engines;

use Illuminate\View\Engines\CompilerEngine;
use Spatie\Mjml\Mjml;

class MjmlEngine extends CompilerEngine
{
    public function get($path, array $data = []): string
    {
        $html = parent::get($path, $data);
        $mjml = Mjml::new();

        if ($mjml->canConvert($html)) {
            return $mjml->minify()->toHtml($html);
        }

        return $html;
    }
}
