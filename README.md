# Roman Numerals

Composer package for conversion between integer values and roman numerals.

Handles numbers from 0 to 3999. For 0 the string 'nulla' is used.

## Installation

### Composer Installation
```
$ composer require komakino/roman-numerals
```
#### Manual Installation

To add this package as a dependency to your project, simply add a dependency on `komakino/roman-numerals` to your project's `composer.json` file.
```json
    {
        "require": {
            "komakino/roman-numerals": "*"
        }
    }
```
Then, run:
```
$ composer update
```
to install the package.

## Usage

```php
use Komakino\RomanNumerals\RomanNumerals;

$roman   = RomanNumerals::to(2016);       // returns 'MMXVI'
$integer = RomanNumerals::from('DCLXVI'); // returns 666
```

### Public static methods

* string **to**($integer)
    * Converts integer to roman numerals
    * If integer is negative, an **OutOfBoundsException** is thrown
    * If integer is larger or equal to 4000, an **OutOfBoundsException** is thrown

* string **from**($string)
    * Converts roman numerals to integer
    * If string contains illegal characters, an **InvalidArgumentException** is thrown

## Changelog

### v1.0.0
* Initial public release
### v1.0.1
* New README file
### v1.0.2
* Added license and author to composer.json
### v1.0.3
* Added LICENSE file
