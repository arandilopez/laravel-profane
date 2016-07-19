<?php

namespace LaravelProfane;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ProfaneServiceProvider extends ServiceProvider
{
  public function register()
  {
    # code...
  }

  public function boot()
  {
    Validator::extend('profane', 'LaravelProfane\ProfaneValidator@validate');
  }
}
