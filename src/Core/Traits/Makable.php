<?php

namespace Raakkan\Yali\Core\Traits;

trait Makable
{
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }
}
