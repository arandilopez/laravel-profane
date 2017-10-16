<?php

namespace LaravelProfane;

use Illuminate\Contracts\Validation\Validator;
use LaravelProfane\Contract\HandlerContract;

class ProfaneValidator
{
    /**
     * [$dictionary description].
     *
     * @var [type]
     */
    protected $dictionary;

    /**
     * [$badwords description].
     *
     * @var array
     */
    protected $badwords = [];

    /**
     * Undocumented function
     *
     * @param HandlerContract $dictionary
     */
    public function __construct(HandlerContract $dictionary)
    {
        $this->dictionary = $dictionary;
        $this->badwords = $dictionary->getDictionary();
    }

    /**
     * Method to extends to Validator.
     *
     * @param string                                     $attribute
     * @param midex                                      $value
     * @param array                                      $parameters
     * @param \Illuminate\Contracts\Validation\Validator $validator  [description]
     *
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
     * Check profanity of text.
     *
     * @param string $text
     *
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
