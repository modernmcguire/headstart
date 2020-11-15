<?php

namespace ModernMcGuire\Headstart\Middleware;

use ModernMcGuire\Headstart\Headstart;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return Headstart::check($request) ? $next($request) : abort(403);
    }
}
