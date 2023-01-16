<?php

use BenSampo\Enum\Enum;
use Illuminate\Support\Collection;

if (! function_exists('join_enums')) {
    function join_enums(Collection $enums, string $glue = '、'): string
    {
        return $enums
            ->map(function (Enum $enum) {
                return $enum->description;
            })
            ->join($glue);
    }
}
