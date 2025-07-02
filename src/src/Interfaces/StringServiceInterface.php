<?php

declare(strict_types=1);

namespace App\src\Interfaces;

interface StringServiceInterface
{
    public function cutStringFromTo(string $string, string $from, string $to): string;
}
