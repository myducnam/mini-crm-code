<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class MailReceiveState extends Enum implements LocalizedEnum
{
    // 受け取り済み
    public const RECEIVED = 'received';

    // 未受け取り
    public const UNRECEIVED = 'unreceived';
}
