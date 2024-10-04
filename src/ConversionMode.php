<?php

namespace Maize\Mjml;

enum ConversionMode: string
{
    case Node = 'node';
    case API = 'api';
    case Custom = 'custom';
}
