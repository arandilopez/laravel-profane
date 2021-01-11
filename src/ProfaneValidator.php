<?php

namespace LaravelProfane;

class ProfaneValidator
{
    /**
     * @var Dictionary
     */
    protected $dictionary;

    /**
     * @var array
     */
    protected $badwords = [];

    /**
     * @param Dictionary $dictionary [description]
     */
    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
        $this->badwords = $dictionary->getDictionary();
    }

    /**
     * Method to extends to Validation Service.
     *
     * @param string $attribute
     * @param mixed  $value
     * @param array  $parameters
     *
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
     * Method to extends to Validation Service for strict word matching.
     *
     * @param string $attribute
     * @param mixed  $value
     * @param array  $parameters
     *
     * @return bool
     */
    public function validateStrict($attribute, $value, $parameters)
    {
        if ($parameters) {
            $this->setDictionary($parameters);
        }

        return !$this->isProfane($value, true);
    }

    /**
     * Check profanity of text.
     *
     * @param string $text
     *
     * @return bool
     */
    public function isProfane($text, $strict = false)
    {
        return Str::containsCaseless(
            $this->sanitizeText($text),
            $this->badwords,
            $strict
        );
    }

    private function setDictionary($dictionaries)
    {
        $this->dictionary->setDictionary($dictionaries);
        $this->badwords = $this->dictionary->getDictionary();
    }

    private function sanitizeText($text)
    {
        return Str::removeAccent(strip_tags($text));
    }
}
