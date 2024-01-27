<?php

namespace App\Enums\Methods;

trait ValuesToList
{
    public static function valuesToList(): array
    {
        return array_map(function ($case){
                return $case->value;
            },
            self::cases()
        );
    }
}
