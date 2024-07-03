<?php

namespace Raakkan\Yali\Core\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Raakkan\Yali\Core\Log\Support\Log\YaliLogManager
 */
class YaliLog extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yali.log';
    }
}
