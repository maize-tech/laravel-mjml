<?php

namespace Maize\Mjml;

use Illuminate\Notifications\Messages\MailMessage as BaseMailMessage;

class MailMessage extends BaseMailMessage
{
    public $view = 'mjml::email';
}
