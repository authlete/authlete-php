<?php
//
// Copyright (C) 2018 Authlete, Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing,
// software distributed under the License is distributed on an
// "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
// either express or implied. See the License for the specific
// language governing permissions and limitations under the
// License.
//


namespace Authlete\Tests\Dto;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Dto\Property;


class PropertyTest extends TestCase
{
    private const KEY   = '_key_';
    private const VALUE = '_value_';


    public function testKeyValidValue()
    {
        $obj = new Property();
        $obj->setKey(self::KEY);

        $this->assertEquals(self::KEY, $obj->getKey());
    }


    public function testKeyValidNull()
    {
        $obj = new Property();
        $obj->setKey(null);

        $this->assertNull($obj->getKey());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testKeyInvalidValue()
    {
        $obj = new Property();

        $invalid = array();
        $obj->setKey($invalid);
    }


    public function testValueValidValue()
    {
        $obj = new Property();
        $obj->setValue(self::VALUE);

        $this->assertEquals(self::VALUE, $obj->getValue());
    }


    public function testValueValidNull()
    {
        $obj = new Property();
        $obj->setValue(null);

        $this->assertNull($obj->getValue());
    }


    /** @expectedException InvalidArgumentException */
    public function testValueInvalidValue()
    {
        $obj = new Property();

        $invalid = array();
        $obj->setValue($invalid);
    }


    public function testHiddenValidValue()
    {
        $obj = new Property();
        $obj->setHidden(true);

        $this->assertEquals(true, $obj->isHidden());
    }


    /** @expectedException InvalidArgumentException */
    public function testHiddenInvalidValue()
    {
        $obj = new Property();

        $invalid = array();
        $obj->setHidden($invalid);
    }


    /** @expectedException InvalidArgumentException */
    public function testHiddenInvalidNull()
    {
        $obj = new Property();
        $obj->setHidden(null);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = Property::fromJson($json);

        $this->assertInstanceof(Property::class, $obj);
    }


    public function testFromJsonKeyValidValue()
    {
        $json = '{"key":"' . self::KEY . '"}';
        $obj  = Property::fromJson($json);

        $this->assertEquals(self::KEY, $obj->getKey());
    }


    public function testFromJsonKeyValidNull()
    {
        $json = '{"key":null}';
        $obj  = Property::fromJson($json);

        $this->assertNull($obj->getKey());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonKeyInvalidBool()
    {
        $json = '{"key":true}';
        $obj  = Property::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonKeyInvalidNumber()
    {
        $json = '{"key":123}';
        $obj  = Property::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonKeyInvalidArray()
    {
        $json = '{"key":["a","b"]}';
        $obj  = Property::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonKeyInvalidObject()
    {
        $json = '{"key":{"a":"b"}}';
        $obj  = Property::fromJson($json);
    }


    public function testFromJsonValueValidValue()
    {
        $json = '{"value":"' . self::VALUE . '"}';
        $obj  = Property::fromJson($json);

        $this->assertEquals(self::VALUE, $obj->getValue());
    }


    public function testFromJsonValueValidNull()
    {
        $json = '{"value":null}';
        $obj  = Property::fromJson($json);

        $this->assertNull($obj->getValue());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidBool()
    {
        $json = '{"value":true}';
        $obj  = Property::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidNumber()
    {
        $json = '{"value":123}';
        $obj  = Property::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidArray()
    {
        $json = '{"value":["a","b"]}';
        $obj  = Property::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidObject()
    {
        $json = '{"value":{"a":"b"}}';
        $obj  = Property::fromJson($json);
    }


    public function testFromJsonHiddenValidValue()
    {
        $json = '{"hidden":true}';
        $obj  = Property::fromJson($json);

        $this->assertEquals(true, $obj->isHidden());
    }


    public function testFromJsonHiddenValidNull()
    {
        $json = '{"hidden":null}';
        $obj  = Property::fromJson($json);

        $this->assertEquals(false, $obj->isHidden());
    }


    public function testFromJsonHiddenValidStringTrue()
    {
        $json = '{"hidden":"true"}';
        $obj  = Property::fromJson($json);

        $this->assertEquals(true, $obj->isHidden());
    }


    public function testFromJsonHiddenValidStringFalse()
    {
        $json = '{"hidden":"false"}';
        $obj  = Property::fromJson($json);

        $this->assertEquals(false, $obj->isHidden());
    }


    public function testFromJsonHiddenInvalidString()
    {
        $json = '{"hidden":"__INVALID__"}';
        $obj  = Property::fromJson($json);

        $this->assertEquals(false, $obj->isHidden());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonHiddenInvalidType()
    {
        $json = '{"hidden":["a","b"]}';
        $obj  = Property::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new Property();
        $obj->setKey(self::KEY)
            ->setValue(self::VALUE)
            ->setHidden(true)
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // key
        $this->assertArrayHasKey('key', $array);
        $this->assertEquals(self::KEY, $array['key']);

        // value
        $this->assertArrayHasKey('value', $array);
        $this->assertEquals(self::VALUE, $array['value']);

        // hidden
        $this->assertArrayHasKey('hidden', $array);
        $this->assertEquals(true, $array['hidden']);
    }
}
?>
