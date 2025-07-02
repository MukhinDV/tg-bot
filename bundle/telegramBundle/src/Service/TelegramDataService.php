<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Service;

use Syrniki\Telegram\Interfaces\TelegramDataServiceInterface;
use Syrniki\Telegram\Value\WebhookValue;

final class TelegramDataService implements TelegramDataServiceInterface
{
    public function getCommandName(WebhookValue $webhookUpdates): string
    {
        $telegramData = $webhookUpdates->getData();

        $commandParts = explode($telegramData, ' ');
        $commandName = ' ' === $commandParts[0] ? $telegramData : $commandParts[0];
        if ($webhookUpdates->isCallback()) {
            return '/'.$commandName;
        }

        return $commandName;
    }
}
