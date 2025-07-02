<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Value;

abstract class WebhookValue
{
    /**
     * @var int
     */
    protected $chatId;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var bool
     */
    protected $bot;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string|null
     */
    protected $lastName;

    /**
     * @var string|null
     */
    protected $username;

    public function __construct(
        int $chatId,
        string $data,
        bool $bot,
        string $firstName,
        ?string $lastName = null,
        ?string $username = null
    ) {
        $this->chatId = $chatId;
        $this->data = $data;
        $this->bot = $bot;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
    }

    abstract public static function fromResponse(array $response): self;

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getBot(): bool
    {
        return $this->bot;
    }

    abstract public function isCallback(): bool;
}
