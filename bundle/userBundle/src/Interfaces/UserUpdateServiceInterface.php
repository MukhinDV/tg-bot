<?php

declare(strict_types=1);

namespace Syrniki\User\Interfaces;

use Syrniki\Order\Value\UserValue;

interface UserUpdateServiceInterface
{
    public function updateUserNamePhone(UserValue $userValue): void;
}
