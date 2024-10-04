<?php

namespace Maize\Mjml\Support;

use Exception;
use Maize\Mjml\ConversionMode;

class Config
{
    public static function getConversionMode(): ConversionMode
    {
        return config('mjml.mode')
            ?? ConversionMode::Node;
    }

    /**
     * @throws Exception
     */
    public static function getConversionAction(): string
    {
        $conversionMode = self::getConversionMode()->value;

        return config("mjml.$conversionMode.action")
            ?? throw new Exception('The action class is required.');
    }

    public static function getConversionParams(): array
    {
        $conversionMode = self::getConversionMode()->value;

        return config("mjml.$conversionMode");
    }

    public static function getConversionParam(string $key): mixed
    {
        return self::getConversionParams()[$key] ?? null;
    }
}
