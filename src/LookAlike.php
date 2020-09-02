<?php

namespace Yaquawa\LookAlike;

class LookAlike
{
    /**
     * @var object|string
     */
    protected $object;

    /**
     * LookAlike constructor.
     * @param object|string $objectOrClass
     */
    public function __construct($objectOrClass)
    {
        $this->object = $objectOrClass;
    }

    /**
     * @param object|string $objectOrClass
     * @param string[] $properties
     * @return LookAlike
     * @throws \ReflectionException
     */
    public function syncProperties($objectOrClass, array $properties = null): self
    {
        foreach (
            $properties ??
                (is_object($objectOrClass)
                    ? Helper::getObjectPropertyNames($objectOrClass)
                    : Helper::getStaticPropertyNames($objectOrClass))
            as $propertyName
        ) {
            try {
                $propertyValue = Helper::getPropertyValue($objectOrClass, $propertyName);
                Helper::setPropertyValue($this->object, $propertyName, $propertyValue);
            } catch (\ReflectionException $e) {
            }
        }

        return $this;
    }

    /**
     * @param object|string $objectOrClass
     * @param string[] $properties
     * @return LookAlike
     * @throws \ReflectionException
     */
    public function syncPropertiesExcept($objectOrClass, array $properties): self
    {
        $filteredProperties = array_filter(
            is_object($objectOrClass)
                ? Helper::getObjectPropertyNames($objectOrClass)
                : Helper::getStaticPropertyNames($objectOrClass),
            function ($propertyName) use ($properties) {
                return !in_array($propertyName, $properties);
            }
        );

        return $this->syncProperties($objectOrClass, $filteredProperties);
    }

    public function get()
    {
        return $this->object;
    }
}
