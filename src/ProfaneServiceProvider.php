<?php

namespace LaravelProfane;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;

class ProfaneServiceProvider extends ServiceProvider
{
  public function boot()
  {
    $this->loadTranslationsFrom(__DIR__.'/lang', 'laravelprofane');

    $this->publishes([
        __DIR__.'/lang' => resource_path('lang/vendor/laravel-profane'),
    ]);

    Validator::extend('profane', 'LaravelProfane\ProfaneValidator@validate', 'The :attribute contains vulgar content.');

    Validator::replacer('profane', function($message, $attribute, $rule, $parameters) {
        return str_replace(':attribute', $attribute, $message);
    });
  }

  public function register()
  {
    // code...
  }
}
