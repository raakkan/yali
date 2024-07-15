<?php

namespace Raakkan\Yali\Core\Exceptions;

use Exception;

class PageRegistrationException extends Exception
{
    public function __construct($message, $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
