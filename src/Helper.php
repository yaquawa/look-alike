<?php

namespace Yaquawa\LookAlike;

use ReflectionClass;
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

    /**
     * @param object|string $objectOrClass
     * @return ReflectionProperty[]
     * @throws \ReflectionException
     */
    public static function getObjectProperties($objectOrClass): array
    {
        return array_filter((new ReflectionClass($objectOrClass))->getProperties(), function (
            ReflectionProperty $property
        ) {
            return !$property->isStatic();
        });
    }

    /**
     * @param object|string $objectOrClass
     * @return ReflectionProperty[]
     * @throws \ReflectionException
     */
    public static function getStaticProperties($objectOrClass): array
    {
        return (new ReflectionClass($objectOrClass))->getProperties(ReflectionProperty::IS_STATIC);
    }

    /**
     * @param object|string $objectOrClass
     * @return string[]
     * @throws \ReflectionException
     */
    public static function getObjectPropertyNames($objectOrClass): array
    {
        return array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, static::getObjectProperties($objectOrClass));
    }

    /**
     * @param object|string $objectOrClass
     * @return string[]
     */
    public static function getStaticPropertyNames($objectOrClass): array
    {
        return static::getPropertyNames($objectOrClass, ReflectionProperty::IS_STATIC);
    }

    /**
     * @param object|string $objectOrClass
     * @param int|null $filter
     * @return string[]
     * @throws \ReflectionException
     */
    public static function getPropertyNames($objectOrClass, int $filter = null): array
    {
        return array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, (new ReflectionClass($objectOrClass))->getProperties($filter));
    }
}
