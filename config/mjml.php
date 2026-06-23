<?php

use Maize\Mjml\Actions\APIConvert;
use Maize\Mjml\Actions\NodeConvert;
use Maize\Mjml\ConversionMode;

return [

    /*
    |--------------------------------------------------------------------------
    | Conversion mode
    |--------------------------------------------------------------------------
    |
    | Here you may specify the conversion mode you may wish to use.
    | Available options are:
    | - Maize\Mjml\ConversionMode::Node
    | - Maize\Mjml\ConversionMode::API
    | - Maize\Mjml\ConversionMode::Custom
    |
    | By default, the value is Maize\Mjml\ConversionMode::Node
    |
    */

    'mode' => ConversionMode::Node,

    'node' => [

        /*
        |--------------------------------------------------------------------------
        | Conversion action
        |--------------------------------------------------------------------------
        |
        | Here you may specify the fully qualified class name of the conversion action.
        | By default, the value is Maize\Mjml\Actions\ConvertMjml::class
        |
        */

        'action' => NodeConvert::class,

        /*
        |--------------------------------------------------------------------------
        | Node options
        |--------------------------------------------------------------------------
        |
        | Here you may specify the options to use when converting MJML to HTML.
        | See available options at https://github.com/mjmlio/mjml#inside-nodejs
        |
        */

        'options' => [
            'keepComments' => true,
            'ignoreIncludes' => false,
            'beautify' => false,
            'minify' => false,
        ],
    ],

    'api' => [

        /*
        |--------------------------------------------------------------------------
        | Conversion action
        |--------------------------------------------------------------------------
        |
        | Here you may specify the fully qualified class name of the conversion action.
        | By default, the value is Maize\Mjml\Actions\ApiConvert::class
        |
        */

        'action' => APIConvert::class,

        /*
        |--------------------------------------------------------------------------
        | API Authentication credentials
        |--------------------------------------------------------------------------
        |
        | Here you may specify the basic auth credentials to use the MJML API.
        |
        */

        'auth_user' => env('MJML_API_AUTH_USER'),
        'auth_password' => env('MJML_API_AUTH_PASSWORD'),
    ],

    'custom' => [

        /*
        |--------------------------------------------------------------------------
        | Conversion action
        |--------------------------------------------------------------------------
        |
        | Here you may specify the fully qualified class name of the conversion action.
        |
        */

        'action' => null,

    ],

];
