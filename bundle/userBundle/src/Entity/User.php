<?php

declare(strict_types=1);

namespace Syrniki\User\Entity;

final class User
{
    private $id;

    private $telegramFirstName;

    private $telegramLastName;

    private $telegramUsername;

    private $telegramId;

    private $isBot;

    private $isAdmin = false;

    private $name;

    private $phone;

    private $createdAt;

    private $updatedAt;

    public function __construct(
        string $telegramFirstName,
        int $telegramId,
        bool $isBot,
        ?string $telegramLastName = null,
        ?string $telegramUsername = null,
        ?string $name = null,
        ?string $phone = null,
        ?int $id = null
    ) {
        $this->telegramFirstName = $telegramFirstName;
        $this->telegramId = $telegramId;
        $this->isBot = $isBot;
        $this->telegramLastName = $telegramLastName;
        $this->telegramUsername = $telegramUsername;
        $this->name = $name;
        $this->phone = $phone;
        $this->id = $id;

        $this->createdAt = new \DateTimeImmutable('now');
        $this->updatedAt = new \DateTimeImmutable('now');
    }

    public function updatePhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function updateName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setAdmin(): void
    {
        $this->isAdmin = true;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}
