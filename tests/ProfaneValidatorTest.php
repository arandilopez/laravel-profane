<?php

use LaravelProfane\ProfaneValidator;
use Illuminate\Support\Facades\Config;
use \Mockery as m;

class ProfaneValidatorTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function test_can_validate_a_word()
    {
        $this->mockConfigs();
        $attribute = 'username';
        $word = 'culero23';
        $parameters = ['es'];

        $profane = new ProfaneValidator();

        $this->assertFalse($profane->validate($attribute, $word, $parameters));
    }

    public function test_can_validate_a_text()
    {
        $this->mockConfigs();
        $attribute = 'description';
        $text = 'fck you bitch';
        $parameters = ['es', 'en'];

        $profane = new ProfaneValidator();

        $this->assertFalse($profane->validate($attribute, $text, $parameters));
    }

    public function test_can_evaluate_profanity_of_a_word()
    {
        $word = 'fuck';
        $this->mockConfigs();

        $profane = new ProfaneValidator();

        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_evaluate_profanity_of_a_sentence()
    {
        $word = 'fuck you if you read this';
        $this->mockConfigs();

        $profane = new ProfaneValidator();

        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_evaluate_profanity_of_a_html_string()
    {
        $word = '<b>fuck</b> you if you read this.';
        $this->mockConfigs();

        $profane = new ProfaneValidator();

        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_evaluate_as_caseless_mode()
    {
        $word = '<b>FUCK</b> you BITCH if you read this.';
        $this->mockConfigs();

        $profane = new ProfaneValidator();

        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_set_dictionary_when_you_pass_a_locale()
    {
        $this->mockConfigs();

        $profane = new ProfaneValidator();
        $profane->setDictionary('es');

        $expected = include __DIR__.'/../src/dict/es.php';

        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_set_dictionary_when_you_pass_a_file()
    {
        $this->mockConfigs();

        $profane = new ProfaneValidator();
        $profane->setDictionary(__DIR__.'/../src/dict/es.php');

        $expected = include __DIR__.'/../src/dict/es.php';

        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_set_dictionary_when_you_pass_an_array_of_files()
    {
        $this->mockConfigs();

        $profane = new ProfaneValidator();
        $profane->setDictionary([__DIR__.'/../src/dict/es.php', __DIR__.'/../src/dict/en.php']);

        $expected = array_merge(include __DIR__.'/../src/dict/es.php', include __DIR__.'/../src/dict/en.php');

        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_set_dictionary_when_you_pass_an_array_of_locales()
    {
        $this->mockConfigs();

        $profane = new ProfaneValidator();
        $profane->setDictionary(['es', 'en']);

        $expected = array_merge(include __DIR__.'/../src/dict/es.php', include __DIR__.'/../src/dict/en.php');

        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_validate_a_bad_word_with_accent()
    {
        $this->mockConfigs();

        $profane = new ProfaneValidator();
        $profane->setDictionary('sk');

        $word = "piča";

        $this->assertTrue( $profane->isProfane($word) );
    }

    private function mockConfigs()
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
