<?php

namespace Maize\Mjml\Engines;

use Illuminate\View\Engines\CompilerEngine;
use Maize\Mjml\Support\Config;

class MjmlEngine extends CompilerEngine
{
    public function get($path, array $data = []): string
    {
        return app(Config::getConversionAction())(
            parent::get($path, $data)
        );
    }
}
