<?php

namespace LaravelProfaneTests\Handler;

use LaravelProfaneTests\TestCase;
use LaravelProfane\Handler\Dictionary\Dictionary;

class DictionaryTest extends TestCase
{
    public function test_words_from_only_one_locale()
    {
        $dictionary = new Dictionary('es');

        $expected = include __DIR__.'/../../src/Handler/Dictionary/dict/es.php';

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }

    public function test_words_from_only_one_file()
    {
        $dictionary = new Dictionary(__DIR__.'/../../src/Handler/Dictionary/dict/es.php');

        $expected = include __DIR__.'/../../src/Handler/Dictionary/dict/es.php';

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }

    public function test_words_from_locale_array()
    {
        $dictionary = new Dictionary([
            'es',
            'gr',
        ]);

        $expected = array_merge(
            include __DIR__.'/../../src/Handler/Dictionary/dict/es.php',
            include __DIR__.'/../../src/Handler/Dictionary/dict/gr.php'
        );

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }

    public function test_words_from_file_array()
    {
        $dictionary = new Dictionary([
            __DIR__.'/../../src/Handler/Dictionary/dict/es.php',
            __DIR__.'/../../src/Handler/Dictionary/dict/gr.php',
            __DIR__.'/../../src/Handler/Dictionary/dict/it.php',
        ]);

        $expected = array_merge(
            include __DIR__.'/../../src/Handler/Dictionary/dict/es.php',
            include __DIR__.'/../../src/Handler/Dictionary/dict/gr.php',
            include __DIR__.'/../../src/Handler/Dictionary/dict/it.php'
        );

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }
}
