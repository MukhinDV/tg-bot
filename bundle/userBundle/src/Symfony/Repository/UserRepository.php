<?php

declare(strict_types=1);

namespace Syrniki\User\Symfony\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Syrniki\User\Entity\User;
use Syrniki\User\Interfaces\UserRepositoryInterface;

final class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByTelegramUserId(int $telegramUserId): ?User
    {
        return $this->findOneBy(['telegramId' => $telegramUserId]);
    }

    public function save(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
}
