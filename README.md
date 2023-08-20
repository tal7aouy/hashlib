# HashLib

The `HashLib` library provides a convenient and flexible way to generate, hash, and validate passwords with various
options and requirements. It includes a trait named `Hasher` that defines password generation, validation, and
requirement checking functionalities.

## Table of Contents

1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Usage](#usage)
    - [Basic Hashing](#basic-hashing)
    - [Hashing with Salt](#hashing-with-salt)
    - [Password Requirement Checking](#password-requirement-checking)
4. [Methods](#methods)
    - [setLength](#setlength)
    - [setUseLowerCase](#setuselowercase)
    - [setUseUpperCase](#setuseuppercase)
    - [setUseNumbers](#setusenumbers)
    - [setUseSymbols](#setusesymbols)
    - [setPasswordRequirements](#setpasswordrequirements)
    - [generateSalt](#generatesalt)
    - [isHashed](#ishashed)
    - [hash](#hash)
    - [verify](#verify)
    - [hashWithSalt](#hashwithsalt)
    - [verifyWithSalt](#verifywithsalt)
    - [setPassword](#setpassword)
    - [getPassword](#getpassword)
    - [meetsRequirements](#meetsrequirements)
5. [Conclusion](#conclusion)

## Introduction

The `HashLib` library is designed to simplify password hashing and verification in PHP applications. It offers a trait
called `Hasher` that can be easily incorporated into your own classes to handle password-related operations.

## Installation

The library can be installed using Composer:

```bash
composer require tal7aouy/hashlib
```

## Usage

### Basic Hashing

```php
use Tal7aouy\HashLib\HashLib;
$passwordHash = HashLib::getInstance();
$password = "my_secure_password";
$hashedPassword = $passwordHash::hash($password);

if ($passwordHash::verify($password, $hashedPassword)) {
    echo "Password is verified!";
} else {
    echo "Password verification failed.";
}

```

### Hashing with Salt
```php

use Tal7aouy\HashLib\HashLib;
$passwordHash = HashLib::getInstance();

$password = "my_secure_password";
$hashedData = $passwordHash::hashWithSalt($password);

if ($passwordHash::verifyWithSalt($password, $hashedData['hash'], $hashedData['salt'])) {
echo "Password is verified!";
} else {
echo "Password verification failed.";
}
```

### Password Requirement Checking

```php
use Tal7aouy\HashLib\HashLib;

$passwordValidator = HashLib::getInstance();
$passwordValidator->setUseLowerCase(true);
$passwordValidator->setUseUpperCase(true);
$passwordValidator->setUseNumbers(true);
$passwordValidator->setUseSymbols(true);

$password = "Complex@Passw0rd";
$result = $passwordValidator->meetsRequirements($password);

if ($result === true) {
echo "Password meets all requirements.";
} else {
echo "Password requirements not met: " . $result;
}
```

## Methods

For a comprehensive list of methods and their descriptions, please refer to the [full documentation](#methods).

Below is a quick overview of some of the key methods available in the `HashLib` library:

### setLength

Set the minimum required length for generated passwords.

### setUseLowerCase

Specify whether lowercase letters are required in generated passwords.

### setUseUpperCase

Specify whether uppercase letters are required in generated passwords.

### setUseNumbers

Specify whether numbers are required in generated passwords.

### setUseSymbols

Specify whether symbols are required in generated passwords.

### setPasswordRequirements

Set multiple password requirements at once.

### generateSalt

Generate a random salt using base64 encoding.

### isHashed

Check if a password is already hashed.

### hash

Hash a password using the specified algorithm and options.

### verify

Verify if a password matches a given hash.

### hashWithSalt

Hash a password with a randomly generated salt.

### verifyWithSalt

Verify if a password, when combined with a salt, matches a given hash.

### setPassword

Set the password to be used for hashing and validation.

### getPassword

Get the currently set password.

### meetsRequirements

Check if a given password meets the specified requirements.

For detailed usage instructions and examples, please see the [Usage](#usage) section above.
## conclusion
**Version:** 1.0.0 
 
**License:** [MIT](LICENSE)

For any questions, issues, or feedback, please reach out to the library's author, Mhammed Talhaouy.
