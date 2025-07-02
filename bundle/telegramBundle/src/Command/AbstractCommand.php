<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Command;

use Syrniki\Telegram\Interfaces\CommandInterface;
use Syrniki\Telegram\Interfaces\TelegramClientInterface;

abstract class AbstractCommand implements CommandInterface
{
    /**
     * @var TelegramClientInterface
     */
    protected $telegramClient;

    /**
     * @var string
     */
    protected $name;

    public function __construct(TelegramClientInterface $telegramClient, string $name)
    {
        $this->telegramClient = $telegramClient;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isAdminCommand(): bool
    {
        return false;
    }
}
