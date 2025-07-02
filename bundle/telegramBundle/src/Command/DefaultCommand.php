<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Command;

use Syrniki\Telegram\Interfaces\TelegramClientInterface;
use Syrniki\Telegram\Value\WebhookValue;

final class DefaultCommand extends AbstractCommand
{
    /**
     * @var string
     */
    protected $name = '/default';

    public const COMMAND_NAME = '/default';

    public function __construct(TelegramClientInterface $telegramClient)
    {
        parent::__construct($telegramClient, $this->name);
    }

    public function execute(WebhookValue $webhookValue): void
    {
        $this->telegramClient->sendMessage(
            $webhookValue->getChatId(),
            'К сожалению, я ещё не знаю как ответить на эту команду)'
        );
    }
}
