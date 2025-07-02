<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Value;

final class WebhookCommandValue extends WebhookValue
{
    public static function fromResponse(array $response): WebhookValue
    {
        return new self(
            $response['message']['chat']['id'],
            $response['message']['text'],
            $response['message']['from']['is_bot'],
            $response['message']['from']['first_name'],
            $response['message']['from']['last_name'],
            $response['message']['from']['username']
        );
    }

    public function isCallback(): bool
    {
        return false;
    }
}
