<?php

namespace LaravelProfaneTests;

use Illuminate\Support\Facades\Config;
use Mockery;
use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * [setUp description].
     */
    public function setUp()
    {
        parent::setUp();
        $this->mockConfigs();
    }

    /**
     * [tearDown description].
     *
     * @return [type] [description]
     */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * [mockConfigs description].
     *
     * @return void
     */
    protected function mockConfigs()
    {
        Config::shouldReceive('get')
            ->once()
            ->with('app.locale')
            ->andReturn('en');

        Config::shouldReceive('has')
            ->once()
            ->with('app.locale')
            ->andReturn(true);
    }
}
