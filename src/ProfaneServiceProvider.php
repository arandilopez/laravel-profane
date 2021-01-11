<?php

namespace LaravelProfane;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ProfaneServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/lang', 'laravel-profane');

        $this->publishes([
            __DIR__.'/lang' => resource_path('lang/vendor/laravel-profane'),
        ]);

        // Rule for caseless content matching
        Validator::extend('profane', 'LaravelProfane\ProfaneValidator@validate', Lang::get('laravel-profane::validation.profane'));

        Validator::replacer('profane', function ($message, $attribute) {
            return str_replace(':attribute', $attribute, $message);
        });

        // Rule for caseless but strict word matching
        Validator::extend('strictly_profane', 'LaravelProfane\ProfaneValidator@validateStrict', Lang::get('laravel-profane::validation.profane'));

        Validator::replacer('strictly_profane', function ($message, $attribute) {
            return str_replace(':attribute', $attribute, $message);
        });
    }
}
