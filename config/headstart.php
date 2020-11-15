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
];
