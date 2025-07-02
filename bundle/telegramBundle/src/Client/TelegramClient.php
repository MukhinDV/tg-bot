<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Client;

use GuzzleHttp\Psr7;
use GuzzleHttp\RequestOptions;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;
use Syrniki\Telegram\Transport\GuzzleTransport;
use Syrniki\Telegram\Value\InitialWebhookValue;
use Syrniki\Telegram\Value\WebhookInfoValue;

final class TelegramClient implements TelegramClientInterface
{
    /**
     * @var GuzzleTransport
     */
    private $guzzleTransport;

    public function __construct(GuzzleTransport $guzzleTransport)
    {
        $this->guzzleTransport = $guzzleTransport;
    }

    public function setWebhook(string $urn): InitialWebhookValue
    {
        $response = $this->guzzleTransport->requestPost('setWebhook', ['url' => $urn]);

        return InitialWebhookValue::fromResponse($response);
    }

    public function deleteWebhook(): InitialWebhookValue
    {
        $response = $this->guzzleTransport->requestPost('deleteWebhook');

        return InitialWebhookValue::fromResponse($response);
    }

    public function getWebhookInfo(): WebhookInfoValue
    {
        $response = $this->guzzleTransport->requestPost('getWebhookInfo');

        return WebhookInfoValue::fromResponse($response);
    }

    public function sendMessage(int $chatId, string $text, ?string $replyMarkup = null): void
    {
        $data = [
            'text' => $text,
            'chat_id' => $chatId,
        ];

        if (null !== $replyMarkup) {
            $data['reply_markup'] = $replyMarkup;
        }

        $this->guzzleTransport->requestPost('sendMessage', $data);
    }

    public function sendPhoto(int $chatId, string $photo, ?string $replyMarkup = null): void
    {
        $this->guzzleTransport->requestPost(
            'sendPhoto',
            [
                [
                    'name' => 'photo',
                    'contents' => Psr7\Utils::tryFopen($photo, 'r'),
                ],
                [
                    'name' => 'chat_id',
                    'contents' => $chatId,
                ],
                [
                    'name' => 'reply_markup',
                    'contents' => $replyMarkup,
                ],
            ],
            RequestOptions::MULTIPART);
    }
}
