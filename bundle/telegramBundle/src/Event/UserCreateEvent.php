<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Event;

final class UserCreateEvent
{
    private $telegramUserId;

    private $bot;

    private $telegramFirstName;

    private $telegramLastName;

    private $username;

    public function __construct(
        int $telegramUserId,
        bool $bot,
        string $telegramFirstName,
        ?string $telegramLastName = null,
        ?string $username = null
    ) {
        $this->telegramUserId = $telegramUserId;
        $this->bot = $bot;
        $this->telegramFirstName = $telegramFirstName;
        $this->telegramLastName = $telegramLastName;
        $this->username = $username;
    }

    public function getTelegramUserId(): int
    {
        return $this->telegramUserId;
    }

    public function getBot(): bool
    {
        return $this->bot;
    }

    public function getTelegramFirstName(): string
    {
        return $this->telegramFirstName;
    }

    public function getTelegramLastName(): ?string
    {
        return $this->telegramLastName;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
}
