<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Interfaces;

use Syrniki\Telegram\Value\InitialWebhookValue;
use Syrniki\Telegram\Value\WebhookInfoValue;

/**
 * @see https://core.telegram.org/bots/api#
 */
interface TelegramClientInterface
{
    public function setWebhook(string $urn): InitialWebhookValue;

    public function deleteWebhook(): InitialWebhookValue;

    public function getWebhookInfo(): WebhookInfoValue;

    public function sendMessage(int $chatId, string $text, ?string $replyMarkup = null): void;

    public function sendPhoto(int $chatId, string $photo, ?string $replyMarkup = null): void;
}
