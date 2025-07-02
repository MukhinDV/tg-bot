<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Event;

final class UserAdminEvent
{
    /**
     * @var int
     */
    private $telegramUserId;

    public function __construct(int $telegramUserId)
    {
        $this->telegramUserId = $telegramUserId;
    }

    public function getTelegramUserId(): int
    {
        return $this->telegramUserId;
    }
}
