<?php

namespace Raakkan\Yali\Core\Database\Enums;

enum CreatedBy: string
{
    case SYSTEM = 'system';
    case USER = 'user';
}