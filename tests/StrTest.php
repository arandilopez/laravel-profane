<?php

namespace LaravelProfaneTests;

use LaravelProfaneTests\TestCase;
use LaravelProfane\Str;

class StrTest extends TestCase
{
    public function test_remove_accents_in_spanish_text()
    {
        $this->assertEquals('cojon', Str::removeAccent('cojón'));
    }

    public function test_enie_char_is_allowed()
    {
        $this->assertEquals('coño', Str::removeAccent('coño'));
    }

    public function test_remove_accents_in_greek()
    {
        $this->assertEquals('μαλακας', Str::removeAccent('μαλάκας'));
    }
}
