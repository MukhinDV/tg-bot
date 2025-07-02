<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Command;

use Syrniki\Telegram\Interfaces\KeyboardInterface;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;
use Syrniki\Telegram\Value\WebhookValue;

final class ContactsCommand extends AbstractCommand
{
    /**
     * @var string
     */
    protected $name = '/contacts';

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
        $this->telegramClient->sendMessage(
            $webhookValue->getChatId(),
            'Со мной можно связаться так то',
            $this->keyboard->getKeyboard()
        );
    }
}
