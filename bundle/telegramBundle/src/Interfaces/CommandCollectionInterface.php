<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Interfaces;

interface CommandCollectionInterface
{
    public function getCommand(string $name): CommandInterface;
}
