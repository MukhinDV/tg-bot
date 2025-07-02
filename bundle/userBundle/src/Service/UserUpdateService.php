<?php

declare(strict_types=1);

namespace Syrniki\User\Service;

use Syrniki\Order\Value\UserValue;
use Syrniki\User\Interfaces\UserRepositoryInterface;
use Syrniki\User\Interfaces\UserUpdateServiceInterface;

final class UserUpdateService implements UserUpdateServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function updateUserNamePhone(UserValue $userValue): void
    {
        $user = $this->userRepository->findByTelegramUserId($userValue->getTelegramUserId());
        $needUpdate = false;

        if ($user->getPhone() !== $userValue->getPhone()) {
            $user->updatePhone($userValue->getPhone());
            $needUpdate = true;
        }

        if ($user->getName() !== $userValue->getName()
        ) {
            $user->updateName($userValue->getName());
            $needUpdate = true;
        }

        if ($needUpdate) {
            $this->userRepository->save($user);
        }
    }
}
