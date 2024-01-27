<?php

namespace App\Enums;
use App\Enums\Methods\ValuesToList;
enum Categories : string {
    use ValuesToList;
    case GROCERIES = 'GROCERIES';
    case COSMETICS = "COSMETICS";
    case FEE = "FEE";
    case CREDIT = "CREDIT";
    case ENTERTAINMENT = "ENTERTAINMENT";
    case DEVELOPMENT = "DEVELOPMENT";
    case UNFORESEEN = "UNFORESEEN";
    public function getDescription(): string {
        return match ($this) {
            self::GROCERIES => 'Zakupy spożywcze',
            self::COSMETICS => 'Kosmetyki',
            self::FEE => 'Opłaty',
            self::CREDIT => 'Kredyt',
            self::ENTERTAINMENT => 'Rozrywka',
            self::DEVELOPMENT => 'Rozwój',
            self::UNFORESEEN => 'Nieprzewidziany wydatek',
            default => 'Zakupy spożywcze',
        };
    }

}
