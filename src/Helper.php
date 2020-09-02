<?php

namespace Yaquawa\LookAlike;

use ReflectionProperty;

class Helper
{
    /**
     * @param object|string $objectOrClass
     * @param string $propertyName
     * @throws \ReflectionException
     */
    public static function getPropertyValue($objectOrClass, string $propertyName)
    {
        $reflectionProperty = static::makePublicProperty($objectOrClass, $propertyName);

        return is_object($objectOrClass)
            ? $reflectionProperty->getValue($objectOrClass)
            : $reflectionProperty->getValue();
    }

    /**
     * @param object|string $objectOrClass
     * @param string $propertyName
     * @param $propertyValue
     * @throws \ReflectionException
     */
    public static function setPropertyValue($objectOrClass, string $propertyName, $propertyValue): void
    {
        $reflectionProperty = static::makePublicProperty($objectOrClass, $propertyName);

        is_object($objectOrClass)
            ? $reflectionProperty->setValue($objectOrClass, $propertyValue)
            : $reflectionProperty->setValue($propertyValue);
    }

    /**
     * @param object|string $objectOrClass
     * @param string $propertyName
     * @throws \ReflectionException
     */
    public static function makePublicProperty($objectOrClass, string $propertyName): ReflectionProperty
    {
        $class = is_object($objectOrClass) ? get_class($objectOrClass) : $objectOrClass;

        $reflectionProperty = new ReflectionProperty($class, $propertyName);

        $reflectionProperty->setAccessible(true);

        return $reflectionProperty;
    }
}
