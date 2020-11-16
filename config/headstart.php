<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Headstart Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Headstart will be accessible from. If the
    | setting is null, Headstart will reside under the same domain as the
    | application. Otherwise, this value will be used as the subdomain.
    |
    */

    'domain' => env('HEADSTART_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | Headstart Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Headstart will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => env('HEADSTART_PATH', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Headstart Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to the public Headstart routes, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'page_middleware' => [
        'web'
    ],

    /*
    |--------------------------------------------------------------------------
    | Headstart Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to the admin Headstart route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'admin_middleware' => [
        'web',
        ModernMcGuire\Headstart\Middleware\Authorize::class,
    ],
];
