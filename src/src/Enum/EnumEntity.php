<?php

declare(strict_types=1);

namespace App\src\Enum;

class EnumEntity implements \Stringable
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function is(string $value): bool
    {
        return $value === $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
