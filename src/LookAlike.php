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
     * @param string[] $properties
     * @param object|string $objectOrClass
     */
    public function syncProperties(array $properties, $objectOrClass): self
    {
        foreach ($properties as $propertyName) {
            $propertyValue = Helper::getPropertyValue($objectOrClass, $propertyName);
            Helper::setPropertyValue($this->object, $propertyName, $propertyValue);
        }

        return $this;
    }

    public function get()
    {
        return $this->object;
    }
}
