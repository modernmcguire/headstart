<?php

namespace ModernMcGuire\Headstart\Traits;

trait AuthorizesRequests
{
    /**
     * The callback that should be used to authenticate Headstart users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Register the Headstart authentication callback.
     *
     * @param  \Closure  $callback
     * @return static
     */
    public static function auth($callback)
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given request can access the Headstart dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }
}
