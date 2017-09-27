<?php

namespace LaravelProfaneTests;

use LaravelProfaneTests\TestCase;
use LaravelProfane\Str;

class StrTest extends TestCase
{
    public function test_string_contains_a_piece_insensitive_match_from_text()
    {
        $this->assertTrue(Str::containsCaseless('Fuck! This class is so bad!', 'ass'));
    }

    public function test_text_contains_insensitive_match_from_array()
    {
        $this->assertTrue(Str::containsCaseless('Fuck! This class is so bad!', ['fuk', 'fuck']));
    }

    public function test_text_contains_insensitive_match_from_string()
    {
        $this->assertTrue(Str::containsCaseless('Fuck! This class is so bad!', 'fUcK'));
    }

    public function test_text_contains_the_same_insensitive_match_from_string()
    {
        $this->assertTrue(Str::containsCaseless('Fuck! This class is so bad!', 'Fuck'));
    }

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
