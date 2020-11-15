<?php

namespace ModernMcGuire\Headstart;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class HeadstartApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->authorization();
    }

    /**
     * Configure the Headstart authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        Headstart::auth(function ($request) {
            return app()->environment('local') ||
                   Gate::check('viewHeadstart', [$request->user()]);
        });
    }

    /**
     * Register the Headstart gate.
     *
     * This gate determines who can access Headstart in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewHeadstart', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
