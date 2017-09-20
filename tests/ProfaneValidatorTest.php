<?php

namespace LaravelProfaneTests;

use LaravelProfaneTests\TestCase;
use LaravelProfane\ProfaneValidator;

class ProfaneValidatorTest extends TestCase
{
    public function test_can_validate_a_word_with_numbers()
    {
        $attribute = 'username';
        $word = 'culero23';
        $parameters = ['es'];
        $profane = new ProfaneValidator();
        $this->assertFalse($profane->validate($attribute, $word, $parameters));
    }

    public function test_can_validate_a_text()
    {
        $attribute = 'description';
        $text = 'fck you bitch. 幹!';
        $parameters = ['es', 'en' , 'zh-tw'];

        $profane = new ProfaneValidator();

        $this->assertFalse($profane->validate($attribute, $text, $parameters));
    }

    public function test_can_evaluate_profanity_of_a_word()
    {
        $word = 'fuck';
        $profane = new ProfaneValidator();
        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_evaluate_profanity_of_a_sentence()
    {
        $word = 'fuck you if you read this';
        $profane = new ProfaneValidator();
        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_evaluate_profanity_of_a_html_string()
    {
        $word = '<b>fuck</b> you if you read this.';
        $profane = new ProfaneValidator();
        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_evaluate_as_caseless_mode()
    {
        $word = '<b>FUCK</b> you BITCH if you read this.';
        $profane = new ProfaneValidator();
        $this->assertTrue($profane->isProfane($word));
    }

    public function test_match_exact_word()
    {
        $profane = new ProfaneValidator();
        // it thinks class ~= ass
        $this->assertTrue($profane->isProfane('class'));
        // but this should be profane
        $this->assertTrue($profane->isProfane('sucker96'));
    }

    public function test_can_set_dictionary_when_you_pass_a_locale()
    {
        $profane = new ProfaneValidator();
        $profane->setDictionary('es');
        $expected = include __DIR__.'/../src/dict/es.php';
        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_set_dictionary_when_you_pass_a_file()
    {
        $profane = new ProfaneValidator();
        $profane->setDictionary(__DIR__.'/../src/dict/es.php');
        $expected = include __DIR__.'/../src/dict/es.php';
        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_set_dictionary_when_you_pass_an_array_of_files()
    {
        $profane = new ProfaneValidator();
        $profane->setDictionary([__DIR__.'/../src/dict/es.php', __DIR__.'/../src/dict/en.php']);

        $expected = array_merge(include __DIR__.'/../src/dict/es.php', include __DIR__.'/../src/dict/en.php');

        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_set_dictionary_when_you_pass_an_array_of_locales()
    {
        $profane = new ProfaneValidator();
        $profane->setDictionary(['es', 'en', 'it', 'zh-tw']);
        $expected = array_merge(include __DIR__.'/../src/dict/es.php', include __DIR__.'/../src/dict/en.php', include __DIR__.'/../src/dict/it.php', include __DIR__.'/../src/dict/zh-tw.php');
        $this->assertEquals($profane->getBadwords(), $expected);
    }

    public function test_can_validate_a_bad_word_with_accent()
    {
        $profane = new ProfaneValidator();
        $profane->setDictionary('sk');
        $word = "piča";
        $this->assertTrue( $profane->isProfane($word) );
    }

    public function test_enie_in_spanish_is_evaluated()
    {
        $profane = new ProfaneValidator();
        $profane->setDictionary('es');
        $word = "coño";
        // in spanish coño =! cono
        $this->assertTrue( $profane->isProfane($word) );
    }

    public function test_can_validate_a_word_in_greek()
    {
        $this->mockConfigs();

        $profane = new ProfaneValidator();
        $profane->setDictionary('gr');

        $word = "μαλάκας";

        $this->assertTrue($profane->isProfane($word));
    }

    public function test_can_validate_a_text_in_greek()
    {
        $this->mockConfigs();
        $attribute = 'description';
        $text = 'εισαι πουτανα';
        $parameters = ['en' , 'gr'];

        $profane = new ProfaneValidator();

        $this->assertFalse($profane->validate($attribute, $text, $parameters));
    }
}
