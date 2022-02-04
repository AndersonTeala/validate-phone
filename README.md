# Validate Phone Number

A simple phone validator, returning if the phone is mobile, landline or invalid.
Valid only for Brazilian phones (first version).

## Requirements
* PHP
  * 7.0
  * or higher required

## Installing

```sh
composer require andersonteala/validate-phone
```

## Example Usage

For your use, follow the example below:

```PHP
<?php

require __DIR__ . '/vendor/autoload.php';

use AndersonTeala\ValidatePhone\ValidatePhone;

$validator = new ValidatePhone();

$numberData = [
  'ddd' => '11',
  'phone' => '920202020'
];

$type = $validator->validate($numberData);
```