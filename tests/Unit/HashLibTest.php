<?php

use Tal7aouy\HashLib\HashLib;

test('Password meet requirements', function () {
    $passwordHash = HashLib::getInstance();
    $passwordHash->setPasswordRequirements(6, true, true, true, true);
    $passwordHash->setPassword("User@1234");
    expect($passwordHash->meetsRequirements())->toBeTrue();
});

test('Password does not meet requirements', function () {
    $passwordHash = HashLib::getInstance();
    $passwordHash->setPasswordRequirements(6, true, true, true, true);
    $passwordHash->setPassword("User");
    expect($passwordHash->meetsRequirements())->toBeString();
});

test("Hash & Verify Password", function () {
    $passwordHash = HashLib::getInstance();
    $passwordHash->setPassword("User@1234");
    $hash = $passwordHash->hash();
    expect($passwordHash->verify("User@1234", $hash))->toBeTrue();
});

test("Hash & Verify Password with wrong password", function () {
    $passwordHash = HashLib::getInstance();
    $passwordHash->setPassword("User@1234");
    $hash = $passwordHash->hash();
    expect($passwordHash->verify("User@12345", $hash))->toBeFalse();
});

test("Password is hashed", function () {
    $passwordHash = HashLib::getInstance();
    $passwordHash->setPassword("User@1234");
    $hash = $passwordHash->hash();
    expect($passwordHash->isHashed($hash))->toBeTrue();
});
test("Hash and verify password with salt", function () {
    $passwordHash = HashLib::getInstance();
    $passwordHash->setPassword("User@1234");
    $hashed = $passwordHash->hashWithSalt();
    expect($passwordHash->verifyWithSalt("User@1234", $hashed['hash'], $hashed['salt']))->toBeTrue();
});