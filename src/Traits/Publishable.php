<?php

namespace ModernMcGuire\Headstart\Traits;

trait Publishable
{
    public $publishable_field = 'status';

    public function isPublished()
    {
        return $this->attributes[$this->publishable_field] == "published";
    }

    public function scopePublished($query)
    {
        return $query->where($this->publishable_field, 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where($this->publishable_field, 'draft');
    }
}
