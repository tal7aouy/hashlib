<?php
declare(strict_types=1);

/**
 * @author Mhammed Talhaouy
 * @version 1.0.0
 * @license MIT
 * @link https://github.com/tal7aouy/hashlib
 */

namespace Tal7aouy\HashLib;

class HashLib
{
    use Hasher;

    const DEFAULT_ALGORITHM = PASSWORD_BCRYPT;
    const DEFAULT_OPTIONS = [
        'memory_cost' => 1024,
        'time_cost' => 2,
        'threads' => 2,
    ];
    private string $passowrd;
    private static ?HashLib $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): HashLib
    {
        if (self::$instance === null) {
            self::$instance = new HashLib();
        }

        return self::$instance;
    }

    public static function hash(?string $password = null, string $algorithm = self::DEFAULT_ALGORITHM, array $options =
    self::DEFAULT_OPTIONS)
    {
        if ($password == null)
            $password = self::$instance->getPassword();
        return password_hash($password, $algorithm, $options);
    }

    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function hashWithSalt(?string $password = null, string $algorithm = self::DEFAULT_ALGORITHM,
                                        array   $options = self::DEFAULT_OPTIONS): array
    {
        if ($password == null)
            $password = self::$instance->getPassword();

        $salt = self::generateSalt();
        $saltedPassword = $salt . $password;
        $hashedPassword = password_hash($saltedPassword, $algorithm, $options);

        return ['hash' => $hashedPassword, 'salt' => $salt];
    }

    public static function verifyWithSalt(string $password, string $hash, string $salt): bool
    {
        $saltedPassword = $salt . $password;
        return password_verify($saltedPassword, $hash);
    }

    public function setPassword(string $password): self
    {
        if (!empty($password))
            $this->passowrd = $password;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->passowrd;
    }

    public function meetsRequirements(?string $password = null): string|bool
    {
        if ($password == null)
            $password = $this->passowrd;
        $requirementsMet = true;
        $message = "";

        // Check length requirement
        if (strlen($password) < $this->length) {
            $requirementsMet = false;
            $message = "Password length is too short.";
        }

        // Check lowercase requirement
        if ($this->useLowerCase && !preg_match('/[a-z]/', $password)) {
            $requirementsMet = false;
            $message = "Password must include at least one lowercase letter.";
        }

        // Check uppercase requirement
        if ($this->useUpperCase && !preg_match('/[A-Z]/', $password)) {
            $requirementsMet = false;
            $message = "Password must include at least one uppercase letter.";
        }

        // Check numbers requirement
        if ($this->useNumbers && !preg_match('/\d/', $password)) {
            $requirementsMet = false;
            $message = "Password must include at least one number.";
        }

        // Check symbols requirement
        if ($this->useSymbols && !preg_match('/[^a-zA-Z\d]/', $password)) {
            $requirementsMet = false;
            $message = "Password must include at least one symbol.";
        }

        return $requirementsMet ? true : $message;
    }


}
