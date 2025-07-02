<?php

declare(strict_types=1);

namespace Syrniki\User\Interfaces;

use Syrniki\User\Entity\User;

interface UserRepositoryInterface
{
    public function findByTelegramUserId(int $telegramUserId): ?User;

    public function save(User $user): void;
}
