<?php

namespace App\Enums;

enum TaskPriority: string
{
    case High = 'High';
    case Medium = 'Medium';
    case Low = 'Low';

    // gate all enum values
    public static function getValues(): array
    {
        return [
            1 => self::High->value,
            2 => self::Medium->value,
            3 => self::Low->value,
        ];
    }
}
