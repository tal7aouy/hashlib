<?php

namespace Tal7aouy\HashLib;

trait Hasher
{
    private int $length = 10;
    private bool $useLowerCase;
    private bool $useUpperCase;
    private bool $useNumbers;
    private bool $useSymbols;


    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function setUseLowerCase(bool $useLowerCase): void
    {
        $this->useLowerCase = $useLowerCase;
    }

    public function setUseUpperCase(bool $useUpperCase): void
    {
        $this->useUpperCase = $useUpperCase;
    }

    public function setUseNumbers(bool $useNumbers): void
    {
        $this->useNumbers = $useNumbers;
    }

    public function setUseSymbols(bool $useSymbols): void
    {
        $this->useSymbols = $useSymbols;
    }

    public function setPasswordRequirements(int  $length, bool $useLowerCase, bool $useUpperCase, bool $useNumbers,
                                            bool $useSymbols): void
    {
        $this->length = $length;
        $this->useLowerCase = $useLowerCase;
        $this->useUpperCase = $useUpperCase;
        $this->useNumbers = $useNumbers;
        $this->useSymbols = $useSymbols;
    }

    /**
     * @throws \Exception
     */
    public static function generateSalt($length = 16): string
    {
        return base64_encode(random_bytes($length));
    }

    public static function isHashed($password): bool
    {
        return password_get_info($password)['algo'] !== 0;
    }

}