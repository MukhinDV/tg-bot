<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Value;

final class WebhookCallbackValue extends WebhookValue
{
    public static function fromResponse(array $response): WebhookValue
    {
        return new self(
            $response['callback_query']['from']['id'],
            $response['callback_query']['data'],
            $response['callback_query']['from']['is_bot'],
            $response['callback_query']['from']['first_name'],
            $response['callback_query']['from']['last_name'],
            $response['callback_query']['from']['username']
        );
    }

    public function isCallback(): bool
    {
        return true;
    }
}
