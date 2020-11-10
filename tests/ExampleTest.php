<?php

namespace Modernmcguire\Headstart\Tests;

use Orchestra\Testbench\TestCase;
use Modernmcguire\Headstart\HeadstartServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [HeadstartServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
