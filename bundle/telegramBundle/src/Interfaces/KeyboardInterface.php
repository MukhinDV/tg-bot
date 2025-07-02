<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Interfaces;

/**
 * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
 */
interface KeyboardInterface
{
    public function getKeyboard(): string;
}
