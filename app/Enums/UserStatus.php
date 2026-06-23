<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'active';
    case InActive = 'inactive';
    case Suspended = 'suspended';

    public function getLabel(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::InActive => 'In Active',
            self::Suspended => 'Suspended',
        };
    }

    public static function imploaded(): string
    {
        return implode(',', array_map(fn($status) => $status->value, self::cases()));
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Active => 'green',
            self::InActive => 'red',
            self::Suspended => 'yellow',
        };
    }

    public static function options(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
