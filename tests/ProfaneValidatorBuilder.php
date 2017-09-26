<?php

namespace LaravelProfaneTests;

use LaravelProfane\ProfaneValidator;

class ProfaneValidatorBuilder
{
    /**
     * [$profaneValidator description]
     * @var [type]
     */
    protected $profaneValidator;

    /**
     * [__construct description]
     * @param [type] $dictionary [description]
     */
    public function __construct($dictionary = null)
    {
        $this->profaneValidator = new ProfaneValidator;

        if ($dictionary) {
            $this->profaneValidator->setDictionary($dictionary);
        }
    }

    /**
     * [validate description]
     * @param  array  $parameters [description]
     * @return [type]             [description]
     */
    public function validate(array $parameters)
    {
        list($attribute, $text, $parameters) = $parameters;

        return $this->build()->validate($attribute, $text, $parameters);
    }

    /**
     * [build description]
     * @return LaravelProfane\ProfaneValidator
     */
    public function build()
    {
        return $this->profaneValidator;
    }
}
