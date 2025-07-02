<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Command\Admin;

use Syrniki\Telegram\Command\AbstractCommand;

abstract class AbstractAdminCommand extends AbstractCommand
{
    public function isAdminCommand(): bool
    {
        return true;
    }
}
