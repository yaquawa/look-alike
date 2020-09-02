<?php

namespace Tests;

class DummyClass
{
    private static $staticPrivateProperty = 1;
    protected static $staticProtectedProperty = 2;

    private $privateProperty = 3;
    protected $protectedProperty = 4;

    public static function getStaticPrivateProperty()
    {
        return static::$staticPrivateProperty;
    }

    public static function getStaticProtectedProperty()
    {
        return static::$staticProtectedProperty;
    }

    public function getPrivateProperty()
    {
        return $this->privateProperty;
    }

    public function getProtectedProperty()
    {
        return $this->protectedProperty;
    }

    public function setPrivateProperty($value)
    {
        $this->privateProperty = $value;
    }

    public function setProtectedProperty($value)
    {
        $this->protectedProperty = $value;
    }
}
