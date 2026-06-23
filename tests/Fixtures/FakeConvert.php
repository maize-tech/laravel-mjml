<?php

namespace Maize\Mjml\Tests\Fixtures;

class FakeConvert
{
    /**
     * The last MJML value received by the action.
     */
    public static ?string $lastValue = null;

    public function __invoke(string $value): string
    {
        static::$lastValue = $value;

        return '<!-- converted -->'.$value;
    }
}
