COMPATIBILITY
=============

PHP 7.0 was released on December, 2015. The official 'active support'
for PHP 5.6 and older versions has already finished. Even the official
'security support' for the latest version of PHP 5.x series (i.e. PHP
5.6) will be terminated in December, 2018.

However, considering the history of repeated specification changes that
have broken backward compatibility, it is hard to upgrade PHP versions
used in systems even from 5.x to 5.(x+1).

Therefore, PHP 5.x versions are still dominant in the market.

In order to support as many systems as possible, this library supports
PHP 5.4 and newer versions. Consideration points were as follows.

- This library uses `namespace`. The feature is available since PHP
  version 5.3.

- Some parameters for Authlete APIs are 64-bit integer values. However,
  in this library, such parameters are treated as _string or integer_
  because 64-bit integers may not be usable in PHP depending on
  underlying platforms. `JSON_BIGINT_AS_STRING` flag needs to be set to
  `$options` argument of `json_decode()` function in order to prevent
  64-bit integers from being corrupted. `$options` argument of
  `json_decode()` is available since PHP version 5.4.

- To implement enum-like behaviors, we tried to implement an abstract
  base class like `Enum` (because PHP does not support enum). However,
  we gave up defining `Enum` class because (1) the constructor of the
  base class cannot be `protected` and must be `public` if the
  constructor needs to be called from within constructors of sub classes,
  (2) constructors of sub classes cannot be `private` if the constructor
  of the base class is `public`, and (3) the existence of `public`
  constructors breaks the concept of enum. Finally we decided to use
  `trait` to implement enum-like behaviors. `trait` is available since
  PHP version 5.4.

- To implement enum-like behaviors (`EnumTrait`), this library uses
  `ReflectionMethod::setAccessible`, which is available since PHP
  version 5.3.2. The purpose to use `setAccessible` is to make the
  custom class initializer (`initialize`) be `private`. See
  `LanguageUtility::initializeClass` for details.

- Type hinting for `string`, `bool` and other primitive types are
  available only in PHP 7.0 and newer versions.  Therefore, this library
  avoids using type hinting for primitive types.

- Access modifiers for `const` is available only in PHP version 7.1 and
  later versions. In order to support PHP version 5.x, we use
  "`private` variables" instead of `private const`.

- We don't use `::class` because it is not available before PHP 5.5.

To check that the source codes are compatible with PHP 5.4, php lint
should be executed like the following.

```
PHPCMD=/usr/local/Cellar/php54/5.4.45_7/bin/php
find src -name '*.php' -exec $PHPCMD -l '{}' \;
```