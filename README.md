Polish NACE codes
=================

Known as Polska Klasyfikacja Działalności (PKD). Package provides list of subclasses
with their description for revisions:

- 2004 - NACE Rev 1
- 2007 - NACE Rev 2
- 2025 - NACE Rev 2.1

Usage
=====

To check if given PKD exists in given revision:

```php
use SrsBiz\PolishNaceCodes\{Pkd, Version};

$exists = Pkd::isValid('12.34.X', Version::Pkd2025);
```

To get description of given PKD:

```php
use SrsBiz\PolishNaceCodes\{Pkd, Version};

try {
    $description = Pkd::getDescription('62.20.A', Version::Pkd2025);
} catch (\InvalidArgumentException $exception) {
    // Given PKD does not exist in this revision
}
```
