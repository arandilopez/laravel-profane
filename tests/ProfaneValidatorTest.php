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

  public function test_can_evaluate_profanity_of_a_word()
  {
    $word = 'fuck';
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();

    $this->assertTrue($profane->isProfane($word));
  }

  public function test_can_evaluate_profanity_of_a_sentence()
  {
    $word = 'fuck you if you read this';
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();

    $this->assertTrue($profane->isProfane($word));
  }

  public function test_can_evaluate_profanity_of_a_html_string()
  {
    $word = '<b>fuck</b> you if you read this.';
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();

    $this->assertTrue($profane->isProfane($word));
  }

  public function test_can_set_dictionary_when_you_pass_a_locale()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->setDictionary('es');

    $expected = include __DIR__.'/../src/dict/es.php';

    $this->assertEquals($profane->getBadwords(), $expected);
  }

  public function test_can_set_dictionary_when_you_pass_a_file()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->setDictionary(__DIR__.'/../src/dict/es.php');

    $expected = include __DIR__.'/../src/dict/es.php';

    $this->assertEquals($profane->getBadwords(), $expected);
  }

  public function test_can_set_dictionary_when_you_pass_an_array_of_files()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->setDictionary([__DIR__.'/../src/dict/es.php']);

    $expected = include __DIR__.'/../src/dict/es.php';

    $this->assertEquals($profane->getBadwords(), $expected);
  }

  public function test_can_set_dictionary_when_you_pass_an_array_of_locales()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->setDictionary(['es']);

    $expected = include __DIR__.'/../src/dict/es.php';

    $this->assertEquals($profane->getBadwords(), $expected);
  }

  public function test_can_load_dictionary_when_you_pass_a_locale()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->loadDictionary('es');

    $expected = array_merge(include __DIR__.'/../src/dict/en.php', include __DIR__.'/../src/dict/es.php');

    $this->assertEquals($profane->getBadwords(), $expected);
  }

  public function test_can_load_dictionary_when_you_pass_a_file()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->loadDictionary(__DIR__.'/../src/dict/es.php');

    $expected = array_merge(include __DIR__.'/../src/dict/en.php', include __DIR__.'/../src/dict/es.php');

    $this->assertEquals($profane->getBadwords(), $expected);
  }

  public function test_can_load_dictionary_when_you_pass_an_array_of_files()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->loadDictionary([__DIR__.'/../src/dict/es.php']);

    $expected = array_merge(include __DIR__.'/../src/dict/en.php', include __DIR__.'/../src/dict/es.php');

    $this->assertEquals($profane->getBadwords(), $expected);
  }

  public function test_can_load_dictionary_when_you_pass_an_array_of_locales()
  {
    Config::shouldReceive('get')
                    ->once()
                    ->with('app.locale')
                    ->andReturn('en');

    Config::shouldReceive('has')
                    ->once()
                    ->with('app.locale')
                    ->andReturn(true);

    $profane = new ProfaneValidator();
    $profane->loadDictionary(['es']);

    $expected = array_merge(include __DIR__.'/../src/dict/en.php', include __DIR__.'/../src/dict/es.php');

    $this->assertEquals($profane->getBadwords(), $expected);
  }
}
