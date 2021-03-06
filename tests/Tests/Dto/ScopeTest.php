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
use Authlete\Dto\Scope;
use Authlete\Dto\TaggedValue;


class ScopeTest extends TestCase
{
    private const NAME        = '_name_';
    private const DESCRIPTION = '_value_';


    public function testNameValidValue()
    {
        $obj = new Scope();
        $obj->setName(self::NAME);

        $this->assertEquals(self::NAME, $obj->getName());
    }


    public function testNameValidNull()
    {
        $obj = new Scope();
        $obj->setName(null);

        $this->assertNull($obj->getName());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testNameInvalidValue()
    {
        $obj = new Scope();

        $invalid = array();
        $obj->setName($invalid);
    }


    public function testDefaultValidValue()
    {
        $obj = new Scope();
        $obj->setDefault(true);

        $this->assertEquals(true, $obj->isDefault());
    }


    /** @expectedException InvalidArgumentException */
    public function testDefaultInvalidValue()
    {
        $obj = new Scope();

        $invalid = array();
        $obj->setDefault($invalid);
    }


    /** @expectedException InvalidArgumentException */
    public function testDefaultInvalidNull()
    {
        $obj = new Scope();
        $obj->setDefault(null);
    }


    public function testDescriptionValidValue()
    {
        $obj = new Scope();
        $obj->setDescription(self::DESCRIPTION);

        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());
    }


    public function testDescriptionValidNull()
    {
        $obj = new Scope();
        $obj->setDescription(null);

        $this->assertNull($obj->getDescription());
    }


    /** @expectedException InvalidArgumentException */
    public function testDescriptionInvalidValue()
    {
        $obj = new Scope();

        $invalid = array();
        $obj->setDescription($invalid);
    }


    public function testDescriptionsValidValue()
    {
        $obj = new Scope();

        $array = array(
            new TaggedValue('tag0', 'value0'),
            new TaggedValue('tag1', 'value1')
        );
        $obj->setDescriptions($array);

        $tags = $obj->getDescriptions();

        $this->assertTrue(is_array($tags));
        $this->assertCount(2, $tags);
        $this->assertInstanceOf(TaggedValue::class, $tags[1]);

        $tag0 = $tags[0];
        $this->assertInstanceOf(TaggedValue::class, $tag0);
        $this->assertEquals('tag0',   $tag0->getTag());
        $this->assertEquals('value0', $tag0->getValue());

        $tag1 = $tags[1];
        $this->assertInstanceOf(TaggedValue::class, $tag1);
        $this->assertEquals('tag1',   $tag1->getTag());
        $this->assertEquals('value1', $tag1->getValue());
    }


    public function testDescriptionsValidNull()
    {
        $obj = new Scope();
        $obj->setDescriptions(null);

        $this->assertNull($obj->getDescriptions());
    }


    /**
     * @expectedException Error
     */
    public function testDescriptionsInvalidType()
    {
        $obj = new Scope();

        $invalid = '__INVALID__';
        $obj->setDescriptions($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testDescriptionsInvalidElement()
    {
        $obj = new Scope();

        $invalid = array('__INVALID__');
        $obj->setDescriptions($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = Scope::fromJson($json);

        $this->assertInstanceof(Scope::class, $obj);
    }


    public function testFromJsonNameValidValue()
    {
        $json = '{"name":"' . self::NAME . '"}';
        $obj  = Scope::fromJson($json);

        $this->assertEquals(self::NAME, $obj->getName());
    }


    public function testFromJsonNameValidNull()
    {
        $json = '{"name":null}';
        $obj  = Scope::fromJson($json);

        $this->assertNull($obj->getName());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonNameInvalidBool()
    {
        $json = '{"name":true}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonNameInvalidNumber()
    {
        $json = '{"name":123}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonNameInvalidArray()
    {
        $json = '{"name":["a","b"]}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonNameInvalidObject()
    {
        $json = '{"name":{"a":"b"}}';
        $obj  = Scope::fromJson($json);
    }


    public function testFromJsonDefaultValidValue()
    {
        $json = '{"defaultEntry":true}';
        $obj  = Scope::fromJson($json);

        $this->assertEquals(true, $obj->isDefault());
    }


    public function testFromJsonDefaultValidNull()
    {
        $json = '{"defaultEntry":null}';
        $obj  = Scope::fromJson($json);

        $this->assertEquals(false, $obj->isDefault());
    }


    public function testFromJsonDefaultValidStringTrue()
    {
        $json = '{"defaultEntry":"true"}';
        $obj  = Scope::fromJson($json);

        $this->assertEquals(true, $obj->isDefault());
    }


    public function testFromJsonDefaultValidStringFalse()
    {
        $json = '{"defaultEntry":"false"}';
        $obj  = Scope::fromJson($json);

        $this->assertEquals(false, $obj->isDefault());
    }


    public function testFromJsonDefaultInvalidString()
    {
        $json = '{"defaultEntry":"__INVALID__"}';
        $obj  = Scope::fromJson($json);

        $this->assertEquals(false, $obj->isDefault());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDefaultInvalidType()
    {
        $json = '{"defaultEntry":["a","b"]}';
        $obj  = Scope::fromJson($json);
    }


    public function testFromJsonDescriptionValidValue()
    {
        $json = '{"description":"' . self::DESCRIPTION . '"}';
        $obj  = Scope::fromJson($json);

        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());
    }


    public function testFromJsonDescriptionValidNull()
    {
        $json = '{"description":null}';
        $obj  = Scope::fromJson($json);

        $this->assertNull($obj->getDescription());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidBool()
    {
        $json = '{"description":true}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidNumber()
    {
        $json = '{"description":123}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidArray()
    {
        $json = '{"description":["a","b"]}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidObject()
    {
        $json = '{"description":{"a":"b"}}';
        $obj  = Scope::fromJson($json);
    }


    public function testFromJsonDescriptionsValidValue()
    {
        $json = '{"descriptions":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj  = Scope::fromJson($json);

        $descriptions = $obj->getDescriptions();
        $this->assertTrue(is_array($descriptions));
        $this->assertCount(2, $descriptions);

        $description0 = $descriptions[0];
        $this->assertInstanceOf(TaggedValue::class, $description0);
        $this->assertEquals('tag0',   $description0->getTag());
        $this->assertEquals('value0', $description0->getValue());

        $description1 = $descriptions[1];
        $this->assertInstanceOf(TaggedValue::class, $description1);
        $this->assertEquals('tag1',   $description1->getTag());
        $this->assertEquals('value1', $description1->getValue());
    }


    public function testFromJsonDescriptionsValidNull()
    {
        $json = '{"descriptions":null}';
        $obj  = Scope::fromJson($json);

        $this->assertNull($obj->getDescriptions());
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidBool()
    {
        $json = '{"descriptions":true}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidNumber()
    {
        $json = '{"descriptions":123}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidArray()
    {
        $json = '{"descriptions":["a","b"]}';
        $obj  = Scope::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidObject()
    {
        $json = '{"descriptions":{"a":"b"}}';
        $obj  = Scope::fromJson($json);
    }


    public function testToJson()
    {
        $descriptions = array(
            new TaggedValue('tag0', 'value0'),
            new TaggedValue('tag1', 'value1')
        );

        $obj = new Scope();
        $obj->setName(self::NAME)
            ->setDefault(true)
            ->setDescription(self::DESCRIPTION)
            ->setDescriptions($descriptions)
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // name
        $this->assertArrayHasKey('name', $array);
        $this->assertEquals(self::NAME, $array['name']);

        // defaultEntry
        $this->assertArrayHasKey('defaultEntry', $array);
        $this->assertEquals(true, $array['defaultEntry']);

        // description
        $this->assertArrayHasKey('description', $array);
        $this->assertEquals(self::DESCRIPTION, $array['description']);

        // descriptions
        $this->assertArrayHasKey('descriptions', $array);
        $descriptions = $array['descriptions'];

        $this->assertTrue(is_array($descriptions));
        $this->assertCount(2, $descriptions);

        $description0 = $descriptions[0];
        $this->assertTrue(is_array($description0));
        $this->assertArrayHasKey('tag',   $description0);
        $this->assertArrayHasKey('value', $description0);
        $this->assertEquals('tag0',   $description0['tag']);
        $this->assertEquals('value0', $description0['value']);

        $description1 = $descriptions[1];
        $this->assertTrue(is_array($description1));
        $this->assertArrayHasKey('tag',   $description1);
        $this->assertArrayHasKey('value', $description1);
        $this->assertEquals('tag1',   $description1['tag']);
        $this->assertEquals('value1', $description1['value']);
    }
}
?>
