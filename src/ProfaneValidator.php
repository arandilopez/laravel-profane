<?php

namespace LaravelProfane;

use LaravelProfane\Dictionary;
use Illuminate\Contracts\Validation\Validator;

class ProfaneValidator
{
    /**
     * [$dictionary description]
     * @var [type]
     */
    protected $dictionary;

    /**
     * [$badwords description]
     * @var array
     */
    protected $badwords = [];

    /**
     * [__construct description]
     * @param Dictionary $dictionary [description]
     */
    function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
        $this->badwords   = $dictionary->getDictionary();
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
            $this->dictionary->setDictionary($parameters);
            $this->badwords = $this->dictionary->getDictionary();
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
        return Str::containsCaseless(
            Str::removeAccent($text),
            $this->badwords
        );
    }
}
