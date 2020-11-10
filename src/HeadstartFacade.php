<?php

namespace ModernMcGuire\Headstart;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ModernMcGuire\Headstart\Skeleton\SkeletonClass
 */
class HeadstartFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'headstart';
    }
}
