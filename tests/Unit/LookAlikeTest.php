<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tests\DummyClass;
use Yaquawa\LookAlike\LookAlike;

class LookAlikeTest extends TestCase
{
    /**
     * @test
     */
    public function syncProperties()
    {
        $object = new DummyClass();
        $targetObject = new DummyClass();

        $object->setPrivateProperty(10);
        $object->setProtectedProperty(20);

        $this->assertNotEquals($object->getProtectedProperty(), $targetObject->getProtectedProperty());
        $this->assertNotEquals($object->getPrivateProperty(), $targetObject->getPrivateProperty());

        $lookAlike = new LookAlike($targetObject);
        $lookAlike->syncProperties($object, ['privateProperty', 'protectedProperty']);

        $this->assertEquals($object->getProtectedProperty(), $targetObject->getProtectedProperty());
        $this->assertEquals($object->getPrivateProperty(), $targetObject->getPrivateProperty());
    }

    /**
     * @test
     */
    public function syncAllProperties()
    {
        $object = new DummyClass();
        $targetObject = new DummyClass();

        $object->setPrivateProperty(10);
        $object->setProtectedProperty(20);

        $lookAlike = new LookAlike($targetObject);
        $lookAlike->syncProperties($object);
        $lookAlike->syncProperties(DummyClass::class);

        $this->assertEquals($object->getProtectedProperty(), $targetObject->getProtectedProperty());
        $this->assertEquals($object->getPrivateProperty(), $targetObject->getPrivateProperty());
    }

    /**
     * @test
     */
    public function syncPropertiesExcept()
    {
        $object = new DummyClass();
        $targetObject = new DummyClass();

        $object->setPrivateProperty(10);
        $object->setProtectedProperty(20);

        $lookAlike = new LookAlike($targetObject);
        $lookAlike->syncPropertiesExcept($object, ['privateProperty']);

        $this->assertEquals($object->getProtectedProperty(), $targetObject->getProtectedProperty());
        $this->assertNotEquals($object->getPrivateProperty(), $targetObject->getPrivateProperty());
    }
}
