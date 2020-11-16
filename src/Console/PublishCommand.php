<?php

namespace ModernMcGuire\Headstart\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'headstart:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all of the Headstart resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Headstart Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'headstart-provider', '--force' => true]);

        $this->comment('Publishing Headstart Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'headstart-assets', '--force' => true]);

        $this->comment('Publishing Headstart Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'headstart-config', '--force' => true]);
    }
}
