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
use Authlete\Dto\TaggedValue;


class TaggedValueTest extends TestCase
{
    private const TAG   = '_tag_';
    private const VALUE = '_value_';


    public function testTagValidValue()
    {
        $obj = new TaggedValue();
        $obj->setTag(self::TAG);

        $this->assertEquals(self::TAG, $obj->getTag());
    }


    public function testTagValidNull()
    {
        $obj = new TaggedValue();
        $obj->setTag(null);

        $this->assertNull($obj->getTag());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testTagInvalidValue()
    {
        $obj = new TaggedValue();

        $invalid = array();
        $obj->setTag($invalid);
    }


    public function testValueValidValue()
    {
        $obj = new TaggedValue();
        $obj->setValue(self::VALUE);

        $this->assertEquals(self::VALUE, $obj->getValue());
    }


    public function testValueValidNull()
    {
        $obj = new TaggedValue();
        $obj->setValue(null);

        $this->assertNull($obj->getValue());
    }


    /** @expectedException InvalidArgumentException */
    public function testValueInvalidValue()
    {
        $obj = new TaggedValue();

        $invalid = array();
        $obj->setValue($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = TaggedValue::fromJson($json);

        $this->assertInstanceof(TaggedValue::class, $obj);
    }


    public function testFromJsonTagValidValue()
    {
        $json = '{"tag":"' . self::TAG . '"}';
        $obj  = TaggedValue::fromJson($json);

        $this->assertEquals(self::TAG, $obj->getTag());
    }


    public function testFromJsonTagValidNull()
    {
        $json = '{"tag":null}';
        $obj  = TaggedValue::fromJson($json);

        $this->assertNull($obj->getTag());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTagInvalidBool()
    {
        $json = '{"tag":true}';
        $obj  = TaggedValue::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTagInvalidNumber()
    {
        $json = '{"tag":123}';
        $obj  = TaggedValue::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTagInvalidArray()
    {
        $json = '{"tag":["a","b"]}';
        $obj  = TaggedValue::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTagInvalidObject()
    {
        $json = '{"tag":{"a":"b"}}';
        $obj  = TaggedValue::fromJson($json);
    }


    public function testFromJsonValueValidValue()
    {
        $json = '{"value":"' . self::VALUE . '"}';
        $obj  = TaggedValue::fromJson($json);

        $this->assertEquals(self::VALUE, $obj->getValue());
    }


    public function testFromJsonValueValidNull()
    {
        $json = '{"value":null}';
        $obj  = TaggedValue::fromJson($json);

        $this->assertNull($obj->getValue());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidBool()
    {
        $json = '{"value":true}';
        $obj  = TaggedValue::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidNumber()
    {
        $json = '{"value":123}';
        $obj  = TaggedValue::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidArray()
    {
        $json = '{"value":["a","b"]}';
        $obj  = TaggedValue::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonValueInvalidObject()
    {
        $json = '{"value":{"a":"b"}}';
        $obj  = TaggedValue::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new TaggedValue();
        $obj->setTag(self::TAG)
            ->setValue(self::VALUE)
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // key
        $this->assertArrayHasKey('tag', $array);
        $this->assertEquals(self::TAG, $array['tag']);

        // value
        $this->assertArrayHasKey('value', $array);
        $this->assertEquals(self::VALUE, $array['value']);
    }
}
?>
