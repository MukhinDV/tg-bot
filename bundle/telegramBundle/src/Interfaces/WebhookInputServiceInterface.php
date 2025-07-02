<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Interfaces;

use Syrniki\Telegram\Value\WebhookValue;

interface WebhookInputServiceInterface
{
    public function getWebhookUpdates(): WebhookValue;
}
