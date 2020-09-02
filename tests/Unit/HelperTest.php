<?php

namespace Tests\Unit;

use Tests\DummyClass;
use Yaquawa\LookAlike\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * @test
     */
    public function getPrivateProperty()
    {
        $object = new DummyClass();
        $this->assertEquals($object->getPrivateProperty(), Helper::getPropertyValue($object, 'privateProperty'));
    }

    /**
     * @test
     */
    public function getProtectedProperty()
    {
        $object = new DummyClass();
        $this->assertEquals($object->getProtectedProperty(), Helper::getPropertyValue($object, 'protectedProperty'));
    }

    /**
     * @test
     */
    public function getStaticPrivateProperty()
    {
        $staticPrivateProperty = DummyClass::getStaticPrivateProperty();

        $this->assertEquals($staticPrivateProperty, Helper::getPropertyValue(DummyClass::class, 'staticPrivateProperty'));

        $this->assertEquals($staticPrivateProperty, Helper::getPropertyValue(new DummyClass(), 'staticPrivateProperty'));
    }

    /**
     * @test
     */
    public function getStaticProtectedProperty()
    {
        $staticProtectedProperty = DummyClass::getStaticProtectedProperty();

        $this->assertEquals($staticProtectedProperty, Helper::getPropertyValue(DummyClass::class, 'staticProtectedProperty'));

        $this->assertEquals($staticProtectedProperty, Helper::getPropertyValue(new DummyClass(), 'staticProtectedProperty'));
    }

    /**
     * @test
     */
    public function setStaticPrivateProperty()
    {
        Helper::setPropertyValue(DummyClass::class, 'staticPrivateProperty', 'foobar');

        $this->assertEquals('foobar', DummyClass::getStaticPrivateProperty());

        Helper::setPropertyValue(new DummyClass(), 'staticPrivateProperty', 'baz');

        $this->assertEquals('baz', DummyClass::getStaticPrivateProperty());
    }

    /**
     * @test
     */
    public function setStaticProtectedProperty()
    {
        Helper::setPropertyValue(DummyClass::class, 'staticProtectedProperty', 'foobar');

        $this->assertEquals('foobar', DummyClass::getStaticProtectedProperty());

        Helper::setPropertyValue(new DummyClass(), 'staticProtectedProperty', 'baz');

        $this->assertEquals('baz', DummyClass::getStaticProtectedProperty());
    }

    /**
     * @test
     */
    public function setPrivateProperty()
    {
        $object = new DummyClass();
        Helper::setPropertyValue($object, 'privateProperty', 'foobar');

        $this->assertEquals('foobar', $object->getPrivateProperty());
    }

    /**
     * @test
     */
    public function setProtectedProperty()
    {
        $object = new DummyClass();
        Helper::setPropertyValue($object, 'protectedProperty', 'foobar');

        $this->assertEquals('foobar', $object->getProtectedProperty());
    }
}

