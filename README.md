# Laravel Profanity Validator

[![Latest Stable Version](https://poser.pugx.org/arandilopez/laravel-profane/v/stable)](https://packagist.org/packages/arandilopez/laravel-profane)
[![Total Downloads](https://poser.pugx.org/arandilopez/laravel-profane/downloads)](https://packagist.org/packages/arandilopez/laravel-profane)
[![License](https://poser.pugx.org/arandilopez/laravel-profane/license)](https://packagist.org/packages/arandilopez/laravel-profane)
[![Daily Downloads](https://poser.pugx.org/arandilopez/laravel-profane/d/daily)](https://packagist.org/packages/arandilopez/laravel-profane)
[![composer.lock](https://poser.pugx.org/arandilopez/laravel-profane/composerlock)](https://packagist.org/packages/arandilopez/laravel-profane)
[!https://travis-ci.org/arandilopez/laravel-profane.svg?branch=master]

I made this package to perform a validation for swear words using Laravel validation service.

## Instalation

Install via composer
```shell
composer require arandilopez/laravel-profane
```

## Configuration
Add the `ProfaneServiceProvider` class in your `config/app.php` file.

```php
<?php
return [
  // ...

  'providers' => [
    // ...
    LaravelProfane\ProfaneServiceProvider::class,
  ];

  // ...
];
```

Publish vendor lang files if you need to replace by your own.

```shell
php artisan vendor:publish
```

## How to use

This package register a custom validator. You can use in your controller's `validate` function.

```php
<?php
// ...
class MyController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|profane'
    ]);

    // ...
  }
}
```

By default the validator will load the default locale in your `config/app.php` file configuration which by default is `en`. If your locale is not supported, please [post an issue for this project](https://github.com/arandilopez/laravel-profane/issues)

If you want to use others dictionaries you can pass them as parameters in the validator.

```php
<?php
// ...
class MyController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|profane:es,en'
    ]);

    // ...
  }
}
```

You can also send as parameter a path of a file which is a dictionary in order to replace the default dictionary or **add a new non supported locale**.

```php
<?php
// ...
class MyController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|profane:es,en,'.storage('mydicts/fr.php')
    ]);

    // ...
  }
}
```

## Getting Help
If you're stuck getting something to work, or need to report a bug, please [post an issue in the Github Issues for this project](https://github.com/arandilopez/laravel-profane/issues).

## Contributing
If you're interesting in contributing code to this project, clone it by running:

```shell
git clone git@github.com:arandilopez/laravel-profane.git
```

Pull requests are welcome, but please make sure you provide unit tests to cover your changes.

> Please, help to add more locales

## License
This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
