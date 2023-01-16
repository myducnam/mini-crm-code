<?php

if (! function_exists('rate_format')) {
    function rate_format(float $num, int $decimals = null): string
    {
        if (is_null($decimals)) {
            $decimals = config('healthapp.rate_decimals');
        }

        return number_format($num, $decimals);
    }
}

