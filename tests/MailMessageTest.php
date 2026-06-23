<?php

use Maize\Mjml\MailMessage;

it('uses the mjml email view', function () {
    expect((new MailMessage)->view)->toBe('mjml::email');
});
