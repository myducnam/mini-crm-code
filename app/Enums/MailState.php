<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class MailState extends Enum implements LocalizedEnum
{
    // 未送信
    public const UNSENT = 'unsent';

    // 郵送済み
    public const SENT = 'sent';
}
