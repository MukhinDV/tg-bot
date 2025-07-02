<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Command;

use Syrniki\Telegram\Interfaces\KeyboardInterface;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;
use Syrniki\Telegram\Value\WebhookValue;

final class PriceCommand extends AbstractCommand
{
    /**
     * @var string
     */
    protected $name = '/price';

    /**
     * @var KeyboardInterface
     */
    private $keyboard;

    public function __construct(TelegramClientInterface $telegramClient, KeyboardInterface $keyboard)
    {
        $this->keyboard = $keyboard;

        parent::__construct($telegramClient, $this->name);
    }

    public function execute(WebhookValue $webhookValue): void
    {
        $this->telegramClient->sendPhoto(
            $webhookValue->getChatId(),
            '../public/images/price.jpg',
            $this->keyboard->getKeyboard()
        );
    }
}
