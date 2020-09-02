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
        $object = new DummyClass;
        $targetObject = new DummyClass;

        $object->setPrivateProperty(10);
        $object->setProtectedProperty(20);

        $this->assertNotEquals($object->getProtectedProperty(), $targetObject->getProtectedProperty());
        $this->assertNotEquals($object->getPrivateProperty(), $targetObject->getPrivateProperty());

        $lookAlike = new LookAlike($targetObject);
        $lookAlike->syncProperties(['privateProperty', 'protectedProperty'], $object);

        $this->assertEquals($object->getProtectedProperty(), $targetObject->getProtectedProperty());
        $this->assertEquals($object->getPrivateProperty(), $targetObject->getPrivateProperty());
    }
}
