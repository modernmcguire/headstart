<?php

namespace Modernmcguire\Headstart;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Modernmcguire\Headstart\Skeleton\SkeletonClass
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
