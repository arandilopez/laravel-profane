<?php

namespace LaravelProfaneTests\Support;

use LaravelProfane\Dictionary;
use LaravelProfane\ProfaneValidator;

class ProfaneValidatorBuilder
{
    /**
     * [$profaneValidator description].
     *
     * @var [type]
     */
    protected $profaneValidator;

    /**
     * [__construct description].
     *
     * @param [type] $dictionary [description]
     */
    public function __construct($dictionary = null)
    {
        $this->profaneValidator = new ProfaneValidator(new Dictionary($dictionary));
    }

    /**
     * [validate description].
     *
     * @param array $parameters [description]
     *
     * @return [type] [description]
     */
    public function validate(array $parameters, $strict = false)
    {
        list($attribute, $text, $dictionaries) = $parameters;

        if ($strict) {
            return $this->build()->validateStrict($attribute, $text, $dictionaries);
        }

        return $this->build()->validate($attribute, $text, $dictionaries);
    }

    /**
     * [build description].
     *
     * @return LaravelProfane\ProfaneValidator
     */
    public function build()
    {
        return $this->profaneValidator;
    }
}
