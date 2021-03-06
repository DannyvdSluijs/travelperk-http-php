<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk;

use Namelivia\TravelPerk\Exceptions\InvalidConstantValueException;
use ReflectionClass;

abstract class BasicEnum
{
    private static $constCacheArray = null;
    private static $className = null;

    private static function getConstants(): array
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    public static function getConstantValues(): array
    {
        return array_values(self::getConstants());
    }

    protected static function checkValidity(string $value): void
    {
        $constants = self::getConstants();
        if (!in_array($value, $constants)) {
            throw new InvalidConstantValueException(
                'The value '.$value.' is not a valid '.get_called_class().' value'
            );
        }
    }
}
