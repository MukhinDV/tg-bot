<?php

declare(strict_types=1);

namespace Syrniki\User\Symfony\EventListener;

use Syrniki\Telegram\Event\UserAdminEvent;
use Syrniki\Telegram\Exception\TelegramInvalidArgumentException;
use Syrniki\User\Interfaces\UserRepositoryInterface;

final class UserAdminEventListener
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function checkAdmin(UserAdminEvent $event): void
    {
        $telegramUserId = $event->getTelegramUserId();
        $user = $this->userRepository->findByTelegramUserId($telegramUserId);

        $userIsAdmin = $user->isAdmin();

        if (false === $userIsAdmin) {
            throw new TelegramInvalidArgumentException('User: '.$telegramUserId.' doesn\'t admin');
        }
    }
}
