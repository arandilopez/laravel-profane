# Hi!
Thanks to contribute in this project. **Changes and contributions must be added as pull request**

## Add a new dictionary

You can help to make this project better by adding a new dictionary of swear words in your native language. The dictionary file MUST follow this points:

1. It must be a `.php` file in `src/dict`
2. Its filename must be a valid language code, check [here](https://www.science.co.il/language/Locale-codes.php)
3. It must return an array with your swear words
4. You MUST use array brackets declaration instead of `array()` function.
5. Each word must be in a single line
6. Each word must be single quoted
7. Each word MUST NOT contains accents

### Example

```php
<?php
  return [
    'fuck',
    'suck'
  ];
```

**You should provide test of loading and using your dictionary.**

## Extends a dictionary

Also, you can contribute by adding new words in a existing dictionary. You MUST to follow from 5 to 7 in the points above.

## Improvements

Any other improvements are very welcome. Check for [issues](https://github.com/arandilopez/laravel-profane/issues). Remember to provide test for your changes.
