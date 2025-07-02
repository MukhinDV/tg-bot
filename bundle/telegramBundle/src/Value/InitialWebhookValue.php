<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Value;

final class InitialWebhookValue
{
    /**
     * @var bool
     */
    private $status;

    /**
     * @var string
     */
    private $description;

    public function __construct(bool $status, string $description)
    {
        $this->status = $status;
        $this->description = $description;
    }

    public static function fromResponse(array $response): self
    {
        return new self($response['ok'], $response['description']);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isSuccessfulStatus(): bool
    {
        return true === $this->status;
    }
}
