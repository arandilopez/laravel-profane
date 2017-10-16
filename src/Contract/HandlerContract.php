<?php

namespace LaravelProfane\Contract;

interface HandlerContract
{
    /**
     * [getDictionary description].
     *
     * @return [type] [description]
     */
    public function getDictionary();

    /**
     * Set the dictionary to use.
     *
     * @param array|string $dictionary
     */
    public function setDictionary($dictionary);
}
