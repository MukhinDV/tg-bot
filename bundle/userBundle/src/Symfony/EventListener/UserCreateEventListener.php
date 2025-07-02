<?php

declare(strict_types=1);

namespace Syrniki\User\Symfony\EventListener;

use Syrniki\Telegram\Event\UserCreateEvent;
use Syrniki\User\Entity\User;
use Syrniki\User\Interfaces\UserRepositoryInterface;

final class UserCreateEventListener
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserCreateEvent $event): void
    {
        $user = $this->userRepository->findByTelegramUserId($event->getTelegramUserId());

        if (null !== $user) {
            return;
        }

        $user = new User(
            $event->getTelegramFirstName(),
            $event->getTelegramUserId(),
            $event->getBot(),
            $event->getTelegramLastName(),
            $event->getUsername()
        );

        $this->userRepository->save($user);
    }
}
