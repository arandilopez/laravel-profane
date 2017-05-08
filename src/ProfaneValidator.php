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
  public function validate($attribute, $value, $parameters)
  {
    if ($parameters) {
      $this->setDictionary($parameters);
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
    return Str::containsCaseless($text, $this->badwords);
  }

  public function getBadwords()
  {
    return $this->badwords;
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
    $baseDictPath = $this->getBaseDictPath();
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

  protected function getBaseDictPath()
  {
    return property_exists($this, 'baseDictPath') ? $this->baseDictPath : __DIR__ . DIRECTORY_SEPARATOR .'dict/';
  }
}
