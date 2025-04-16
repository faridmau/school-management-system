<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum SchoolTypeEnum: string implements HasLabel
{
    case KINDERGARTEN = 'kindergarten';
    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case HIGH_SCHOOL = 'high_school';
    case COLLEGE = 'college';
    case UNIVERSITY = 'university';
    public function getLabel(): ?string
    {
        return match ($this) {
            self::KINDERGARTEN => 'Kindergarten',
            self::PRIMARY => 'Primary',
            self::SECONDARY => 'Secondary',
            self::HIGH_SCHOOL => 'High School',
            self::COLLEGE => 'College',
            self::UNIVERSITY => 'University',
        };
    }
}
