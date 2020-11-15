<?php

namespace ModernMcGuire\Headstart\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'headstart:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Headstart resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Headstart Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'headstart-provider']);

        $this->comment('Publishing Headstart Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'headstart-assets']);

        $this->comment('Publishing Headstart Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'headstart-config']);

        $this->registerHeadstartServiceProvider();

        $this->info('Headstart scaffolding installed successfully.');
    }

    /**
     * Register the Headstart service provider in the application configuration file.
     *
     * @return void
     */
    protected function registerHeadstartServiceProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace.'\\Providers\\HeadstartServiceProvider::class')) {
            return;
        }

        $lineEndingCount = [
            "\r\n" => substr_count($appConfig, "\r\n"),
            "\r" => substr_count($appConfig, "\r"),
            "\n" => substr_count($appConfig, "\n"),
        ];

        $eol = array_keys($lineEndingCount, max($lineEndingCount))[0];

        // copy ServiceProvider to Application
        file_put_contents(app_path('Providers/HeadstartServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/HeadstartServiceProvider.php'))
        ));

        // add HeadstartServiceProvider to config/app.php
        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\RouteServiceProvider::class,".$eol,
            "{$namespace}\\Providers\RouteServiceProvider::class,".$eol."        {$namespace}\Providers\HeadstartServiceProvider::class,".$eol,
            $appConfig
        ));
    }
}
