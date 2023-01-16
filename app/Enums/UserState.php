<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class UserState extends Enum implements LocalizedEnum
{
    // 画像待ち
    public const PENDING = 'pending';

    // 許可
    public const ACCEPT = 'accept';

    // 却下
    public const REJECT = 'reject';

    // 審査中
    public const REVIEW = 'review';
}
