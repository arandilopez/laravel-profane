<?php

namespace LaravelProfane;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ProfaneServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->loadTranslationsFrom(__DIR__.'/lang', 'laravel-profane');

    $this->publishes([
        __DIR__.'/lang' => resource_path('lang/vendor/laravel-profane'),
    ]);
  }

  public function boot()
  {
    Validator::extend('profane', 'LaravelProfane\ProfaneValidator@validate');

    Validator::replacer('profane', function($message, $attribute, $rule, $parameters) {
        return str_replace(':attribute', $attribute, $message);
    });
  }
}
