<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Command;

use Psr\EventDispatcher\EventDispatcherInterface;
use Syrniki\Telegram\Event\UserCreateEvent;
use Syrniki\Telegram\Interfaces\KeyboardInterface;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;
use Syrniki\Telegram\Value\WebhookValue;

final class StartCommand extends AbstractCommand
{
    /**
     * @var string
     */
    protected $name = '/start';

    /**
     * @var string
     */
    private $uri;

    /**
     * @var KeyboardInterface
     */
    private $keyboard;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        TelegramClientInterface $telegramClient,
        KeyboardInterface $keyboard,
        string $uri,
        EventDispatcherInterface $eventDispatcher
    ) {
        parent::__construct($telegramClient, $this->name);

        $this->uri = $uri;
        $this->keyboard = $keyboard;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(WebhookValue $webhookValue): void
    {
        $this->eventDispatcher->dispatch(
            new UserCreateEvent(
                $webhookValue->getChatId(),
                $webhookValue->getBot(),
                $webhookValue->getFirstName(),
                $webhookValue->getLastName(),
                $webhookValue->getUsername()
            )
        );

        $this->telegramClient->sendMessage(
            $webhookValue->getChatId(),
            'Привет, '.$webhookValue->getFirstName().'!'.PHP_EOL.PHP_EOL.
            'Меня зовут Сырник , я - верный помощник, готов принять у тебя заказ на самые вкусные сырнички в твоей жизни!'.PHP_EOL.PHP_EOL.
            'Принимаю заказы:'.PHP_EOL.
            'Пн - Пт - с 7:00 до 16:00'.PHP_EOL.
            'Сб - с 8:00 до 14:00'.PHP_EOL.
            'Вс - выходной день'.PHP_EOL.PHP_EOL.
            'В случае каких-то проблем напиши хозяйке '.$this->uri,
            $this->keyboard->getKeyboard()
        );
    }
}
