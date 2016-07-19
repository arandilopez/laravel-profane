# Laravel Profanity Valitador

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

By default the validator will load the `en` locale. If you want to use others dictionaries you can pass them as parameters in the validator.

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

You can also send as parameter a path of a file which is a dictionary.

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

## License
This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
