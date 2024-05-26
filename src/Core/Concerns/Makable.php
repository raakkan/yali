<?php

namespace Raakkan\Yali\Core\Concerns;

trait Makable
{
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }
}
