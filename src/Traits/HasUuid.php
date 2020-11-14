<?php

namespace ModernMcGuire\Headstart\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Boot the HasUuid trait for a model.
     *
     * @return void
     */
    public static function bootHasUuid()
    {
        /**
         * Hook into the model's "creating" event and
         * generate a UUID for it.
         */
        static::creating(function ($model) {
            $model->attributes['uuid'] = (string) Str::uuid();
        });
    }

    public function scopeFindByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid)->firstOrFail();
    }
}
