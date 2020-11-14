<?php

namespace ModernMcGuire\Headstart\Traits;

use Spatie\Sluggable\HasSlug as SpatieHasSlug;

trait HasSlug
{
    use SpatieHasSlug;

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
