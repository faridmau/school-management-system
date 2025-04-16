<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';
    case CLOSED = 'closed';

    public function getLabel(): ?string
    {
        return $this->name;

        // or

        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::SUSPENDED => 'Suspended',
            self::CLOSED => 'Closed',
        };
    }
}
