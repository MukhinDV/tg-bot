<?php

declare(strict_types=1);

namespace App\src\Service;

use App\src\Interfaces\StringServiceInterface;

final class StringService implements StringServiceInterface
{
    public function cutStringFromTo(string $string, string $from, string $to): string
    {
        $positionFirstOccurrenceFrom = iconv_strpos($string, $from);

        if (false === $positionFirstOccurrenceFrom) {
            return $string;
        }

        $positionFirstOccurrenceTo = iconv_strpos($string, $to, $positionFirstOccurrenceFrom + iconv_strlen($from));

        return mb_substr($string, $positionFirstOccurrenceTo);
    }
}
