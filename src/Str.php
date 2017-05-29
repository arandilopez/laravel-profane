<?php

namespace LaravelProfane;

class Str
{
    /**
    * Taken from Illuminate\Support\Str
    * Determine if a given string contains a given word with case insensitive match.
    *
    * @param  string  $haystack
    * @param  string|array  $needles
    * @return bool
    */
    public static function containsCaseless($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            $needle = preg_quote($needle);
            if ($needle != '' && preg_match("/$needle/iu", $haystack)) {
                return true;
            }
        }
        return false;
    }
}
