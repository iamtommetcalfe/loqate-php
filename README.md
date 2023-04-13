# Loqate PHP

A simple PHP package for address verification using the Loqate API.

## Installation

Install the package via composer:

```bash
composer require iamtommetcalfe/loqate-php
```

## Usage
To use the package, you'll need to have a valid Loqate API key. You can obtain one by signing up at the [Loqate website](https://www.loqate.com/en-gb/).

Here's an example of how to use the package:
```php
<?php

require_once 'vendor/autoload.php';

use Iamtommetcalfe\Loqate\Loqate;

// Replace 'your-loqate-api-key' with your actual Loqate API key
$loqate = new Loqate('your-loqate-api-key');

// Search for an address
$result = $loqate->verifyAddress('10 Downing St, London');

// Iterate over the results
foreach ($result as $address) {
    echo "ID: " . $address->getId() . PHP_EOL;
    echo "Type: " . $address->getType() . PHP_EOL;
    echo "Text: " . $address->getText() . PHP_EOL;
    echo "---" . PHP_EOL;
}
```