<?php

namespace LaravelProfane;

use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Validation\Validator;

class ProfaneValidator
{

  protected $badwords = [];

  function __construct()
  {
    // Get default locale string in laravel project
    // and set it as default dictionary
    $locale_dict = Config::has('app.locale') ? Config::get('app.locale') : 'en';

    $this->setDictionary($locale_dict);
  }

  /**
   * Method to extends to Validator
   * @param  string $attribute
   * @param  midex $value
   * @param  array $parameters
   * @param  \Illuminate\Contracts\Validation\Validator $validator  [description]
   * @return bool
   */
  public function validate($attribute, $value, $parameters, $validator)
  {
    if ($parameters) {
      $this->loadDictionary($parameters);
    }

    return !$this->isProfane($value);
  }

  /**
   * Check profanity of text
   * @param  string $text
   * @return bool
   */
  public function isProfane($text)
  {
    return str_contains($text, $this->badwords);
  }

  public function getBadwords()
  {
    return $this->badwords;
  }

  /**
   * Merge the current dictionary with the passed
   * @param  array|string $dictionary
   */
  public function loadDictionary($dictionary)
  {
    $this->badwords = array_merge($this->badwords, $this->readDictionary($dictionary));
  }

  /**
   * Set the dictionary to use
   * @param array|string $dictionary
   */
  public function setDictionary($dictionary)
  {
    $this->badwords = $this->readDictionary($dictionary);
  }

  protected function readDictionary($dictionary)
  {
    $badwords = [];
    $baseDictPath = __DIR__ . DIRECTORY_SEPARATOR .'dict/';
    if (is_array($dictionary)) {
      foreach ($dictionary as $file) {
        if (file_exists($baseDictPath.$file.'.php')) {
          $dict = include($baseDictPath.$file.'.php');
          $badwords = array_merge($badwords, $dict);
        } else {
          // if the file isn't in the dict directory,
          // it's probably a custom user library
          $dict = include($file);
          $badwords = array_merge($badwords, $dict);
        }
      }
      // just a single string, not an array
    } elseif (is_string($dictionary)) {
      if (file_exists($baseDictPath.$dictionary.'.php')) {
        $dict = include($baseDictPath.$dictionary.'.php');
        $badwords = array_merge($badwords, $dict);
      } else {
        $dict = include($dictionary);
        $badwords = array_merge($badwords, $dict);
      }
    }

    return $badwords;
  }
}
