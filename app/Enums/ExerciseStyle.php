<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ExerciseStyle extends Enum implements LocalizedEnum
{
    public const STANDING = 'standing';

    public const LIGHT = 'light';
}
