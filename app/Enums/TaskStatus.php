<?php

namespace App\Enums;

enum TaskStatus: string
{
    case New = 'New';
    case InProgress = 'Incomplete';
    case Completed = 'Complete';

    public static function getValues(): array
    {
        return [
            self::New->value,
            self::InProgress->value,
            self::Completed->value,
        ];
    }
}
