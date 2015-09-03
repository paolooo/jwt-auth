<?php

/*
 * This file is part of jwt-auth
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tymon\JWTAuth\Providers;

use Tymon\JWTAuth\Middleware\JWTCheck;
use Tymon\JWTAuth\Middleware\RefreshToken;
use Tymon\JWTAuth\Middleware\GetUserFromToken;

class LaravelServiceProvider extends LumenServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $path = realpath(__DIR__ . '/../../config/config.php');

        $this->publishes([$path => config_path('jwt.php')], 'config');
        $this->mergeConfigFrom($path, 'jwt');

        $this->app['router']->middleware('jwt.auth', 'Tymon\JWTAuth\Middleware\GetUserFromToken');
        $this->app['router']->middleware('jwt.refresh', 'Tymon\JWTAuth\Middleware\RefreshToken');
        $this->app['router']->middleware('jwt.check', 'Tymon\JWTAuth\Middleware\JWTCheck');
    }
}
