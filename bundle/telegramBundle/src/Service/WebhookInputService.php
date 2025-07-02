<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Service;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Syrniki\Telegram\Exception\TelegramTransportException;
use Syrniki\Telegram\Interfaces\WebhookInputServiceInterface;
use Syrniki\Telegram\Value\WebhookCallbackValue;
use Syrniki\Telegram\Value\WebhookCommandValue;
use Syrniki\Telegram\Value\WebhookValue;

final class WebhookInputService implements WebhookInputServiceInterface
{
    use LoggerAwareTrait;

    public function __construct()
    {
        $this->setLogger(new NullLogger());
    }

    public function getWebhookUpdates(): WebhookValue
    {
        $input = file_get_contents('php://input');
        $this->logger->info(sprintf('Receiving data: %s', $input));

        if (empty($input)) {
            throw new TelegramTransportException('Input is empty!');
        }

        try {
            $response = json_decode($input, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new TelegramTransportException(sprintf('Response is not json: %s.', $e->getMessage()));
        }

        return $this->isCallback($response) ? WebhookCallbackValue::fromResponse($response) : WebhookCommandValue::fromResponse($response);
    }

    private function isCallback($response): bool
    {
        return isset($response['callback_query']);
    }
}
