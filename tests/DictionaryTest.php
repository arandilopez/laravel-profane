<?php

namespace LaravelProfaneTests;

use LaravelProfane\Dictionary;

class DictionaryTest extends TestCase
{
    public function test_words_from_only_one_locale()
    {
        $dictionary = new Dictionary('es');

        $expected = include __DIR__.'/../src/dict/es.php';

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }

    public function test_words_from_only_one_file()
    {
        $dictionary = new Dictionary(__DIR__.'/../src/dict/es.php');

        $expected = include __DIR__.'/../src/dict/es.php';

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }

    public function test_words_from_locale_array()
    {
        $dictionary = new Dictionary([
            'es',
            'gr',
        ]);

        $expected = array_merge(
            include __DIR__.'/../src/dict/es.php',
            include __DIR__.'/../src/dict/gr.php'
        );

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }

    public function test_words_from_file_array()
    {
        $dictionary = new Dictionary([
            __DIR__.'/../src/dict/es.php',
            __DIR__.'/../src/dict/gr.php',
            __DIR__.'/../src/dict/it.php',
        ]);

        $expected = array_merge(
            include __DIR__.'/../src/dict/es.php',
            include __DIR__.'/../src/dict/gr.php',
            include __DIR__.'/../src/dict/it.php'
        );

        $this->assertEquals($dictionary->getDictionary(), $expected);
    }
}
