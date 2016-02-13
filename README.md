# Identity

Identity is a composer package to validate, parse, format and extract various information from national identity numbers.

**Current implementations**:
* Swedish personnummer/organisationsnummer
* Danish personnummer/CPR-nummer
* Finnish henkilötunnus/personbeteckning
* Norwegian fødselsnummer

## Installation

To add this package as a dependency to your project, simply add a dependency on `komakino/identity` to your project's `composer.json` file.
```json
    {
        "require": {
            "komakino/identity": "*"
        }
    }
```
## Usage

```php
use Komakino\Identity\National\SwedishIdentity;
use Komakino\Identity\National\DanishIdentity;

$swedishIdentity = new SwedishIdentity('011017-2721');
$danishIdentity = new DanishIdentity('170583-7315');
```

### Common methods

Upon construction, the number is parsed and validated.

If number does not comply to the allowed input formats of the implementation, an IdentityInvalidFormatException will be thrown.

#### Public properties

* bool $valid
    * The validity of the identity number

* mixed \*\*getters\*\*
    * All number properties are accessible as properties on the instance

#### Public methods

* array **listProperties**()
    * Returns all number properties

* bool **hasProperty**(string $property)
    * Checks if the identity's implementation has a property

* string **__toString**()
    * Output the formatted identity number

#### Static methods

* static array **parse**(string $number)
    * Creates an instance and returns all number properties

* static bool **validate**(string $number)
    * Creates an instance and returns the validity of the number

* static string **format**(string $number)
    * Output the formatted identity number

### Swedish personnummer/organisationsnummer

#### Allowed input formats
* `0110172721`
* `011017-2721`
* `011017+2721`
* `200110172721`
* `20011017-2721`
* `20011017+2721`

#### Formatted output
`011017-2721`

#### Number properties
* **type**
    * *organization* or *person*
* **century**
    * Sources for century:
        * Provided in number as **OO**xxxxxx-xxxx
        * The separator is a *+*, which denotes a person is over 100
        * By logical guessing. Pseudo: `year > current_year ? 19 : 20`
* **year**
    * **OO**xxxx-xxxx
* **month**
    * xx**OO**xx-xxxx
* **day**
    * xxxx**OO**-xxxx
* **centuryHint**
    * xxxxx**-**xxxx
    * Defaults to *-*
* **locality**
    * xxxxxx-**OO**xx
* **county**
    * Only available for people born before 1990
* **number**
    * xxxxxx-xx**O**x
* **gender**
    * *male* or *female*
* **checkdigit**
    * xxxxxx-xxx**O**
* **birthday**
    * A **DateTime** object
* **temporary**
    * If the number is of a temporary nature

### Danish personnummer/CPR-nummer

#### Allowed input formats
* `1705837315`
* `170583-7315`

#### Formatted output
`170583-7315`

#### Number properties
* **century**
    * Calculated from *year* and *centuryHint*
* **day**
    * **OO**xxxx-xxxx
* **month**
    * xx**OO**xx-xxxx
* **year**
    * xxxx**OO**-xxxx
* **centuryHint**
    * xxxxxx-**O**xxx
* **sequence**
    * xxxxxx-**OOO0**
* **gender**
    * *male* or *female*
* **birthday**
    * A **DateTime** object


### Finnish personnummer/CPR-nummer

#### Allowed input formats
* `311280-888Y`

#### Formatted output
`311280-888Y`

#### Number properties
* **century**
    * Defined by *centuryHint*
* **day**
    * **OO**xxxx-xxxx
* **month**
    * xx**OO**xx-xxxx
* **year**
    * xxxx**OO**-xxxx
* **centuryHint**
    * xxxxx**-**xxxx
    * *-*/*+*/*A*
* **number**
    * xxxxxx-**OOO**x
* **checkdigit**
    * xxxxxx-xxx**O**
* **gender**
    * *male* or *female*
* **birthday**
    * A **DateTime** object


### Norwegian fødselsnummer

#### Allowed input formats
* `17058332143`

#### Formatted output
`17058332143`

#### Number properties
* **century**
    * Calculated from *year* and *number*
* **day**
    * **OO**xxxxxxxxx
* **month**
    * xx**OO**xxxxxxx
* **year**
    * xxxx**OO**xxxxx
* **number**
    * xxxxxx**OOO**xx
* **checkdigits**
    * xxxxxxxxx**OO**
* **gender**
    * *male* or *female*
* **birthday**
    * A **DateTime** object
* **D-number**
    * *bool* Whether or not this is a D-number. Temporary number provided to immigrants etc.
* **H-number**
    * *bool* Whether or not this is a H-number. Temporary number used by health care etc.

## Changelog

### v1.3.0
* Will now throw an exception if number does'nt comply to the implementations allowed input format.

### v1.2.1
* Fixed issues with parsing zeros.

### v1.2.0
* Added implementation for Norwegian fødselsnummer

### v1.1.0
* Added implementation for Finnish henkilötunnus/personbeteckning

### v1.0.0
* Initial public release
* Added implementation for Swedish personnummer/organisationsnummer
* Added implementation for Danish personnummer/CPR-nummer
