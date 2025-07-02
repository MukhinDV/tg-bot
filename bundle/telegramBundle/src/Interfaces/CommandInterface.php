<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Interfaces;

use Syrniki\Telegram\Value\WebhookValue;

interface CommandInterface
{
    public function execute(WebhookValue $webhookValue): void;

    public function getName(): string;

    public function isAdminCommand(): bool;
}
