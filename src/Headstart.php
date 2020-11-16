<?php

namespace ModernMcGuire\Headstart;

use ModernMcGuire\Headstart\Traits\AuthorizesRequests;

class Headstart
{
    use AuthorizesRequests;

    public function getResources()
    {
        return [];
    }

}
