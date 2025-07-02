<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Value;

final class WebhookInfoValue
{
    /**
     * @var bool
     */
    private $status;

    /**
     * @var string
     */
    private $url;

    public function __construct(bool $status, string $url)
    {
        $this->status = $status;
        $this->url = $url;
    }

    public static function fromResponse(array $response): self
    {
        return new self($response['ok'], $response['result']['url']);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
