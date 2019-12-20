<?php

namespace LaravelProfaneTests;

use Illuminate\Support\Facades\Config;
use Mockery;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    /**
     * [setUp description].
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->mockConfigs();
    }

    /**
     * [tearDown description].
     *
     * @return [type] [description]
     */
    public function tearDown(): void
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
