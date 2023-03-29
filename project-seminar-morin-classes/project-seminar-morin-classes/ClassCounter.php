<?php

declare(strict_types = 1);

class ClassCounter
{
    private static int $CountMethod = 0;
    private static int $GetObject = 0;

    function __construct()
    {
        ClassCounter::$GetObject++;
    }

    function __destruct()
    {
        ClassCounter::$GetObject--;
    }

    public function __call($name, $arguments)
    {
        if ((string) $name === 'callMethod')
        {
            self::$CountMethod++;
        }
    }

    public static function getObjectsNum(): int
    {
        return self::$GetObject;
    }

    public static function getMethodCallNum(): int
    {
        return self::$CountMethod;
    }
}
