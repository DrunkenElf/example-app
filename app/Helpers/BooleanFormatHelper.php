<?php

namespace App\Helpers;

class BooleanFormatHelper
{
    public static function toBoolean(string $val): bool
    {
        return match ($val) {
            '0', 'false' => false,
            '1', 'true' => true
        };
    }
}
