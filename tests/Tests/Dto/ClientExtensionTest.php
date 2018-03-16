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
use Authlete\Dto\ClientExtension;


class ClientExtensionTest extends TestCase
{
    public function testRequestableScopesEnabledValidValue()
    {
        $obj = new ClientExtension();
        $obj->setRequestableScopesEnabled(true);

        $this->assertEquals(true, $obj->isRequestableScopesEnabled());
    }


    /** @expectedException InvalidArgumentException */
    public function testRequestableScopesEnabledInvalidValue()
    {
        $obj = new ClientExtension();

        $invalid = array();
        $obj->setRequestableScopesEnabled($invalid);
    }


    /** @expectedException InvalidArgumentException */
    public function testRequestableScopesEnabledInvalidNull()
    {
        $obj = new ClientExtension();
        $obj->setRequestableScopesEnabled(null);
    }


    public function testRequestableScopesValidValue()
    {
        $obj = new ClientExtension();
        $obj->setRequestableScopes(array('scope0', 'scope1'));

        $scopes = $obj->getRequestableScopes();

        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);
        $this->assertEquals('scope0', $scopes[0]);
        $this->assertEquals('scope1', $scopes[1]);
    }


    public function testRequestableScopesValidNull()
    {
        $obj = new ClientExtension();
        $obj->setRequestableScopes(null);

        $this->assertNull($obj->getRequestableScopes());
    }


    /**
     * @expectedException Error
     */
    public function testRequestableScopesInvalidString()
    {
        $obj = new ClientExtension();

        $invalid = '__INVALID__';
        $obj->setRequestableScopes($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testRequestableScopesInvalidArray()
    {
        $obj = new ClientExtension();

        $invalid = array(array(), array());
        $obj->setRequestableScopes($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = ClientExtension::fromJson($json);

        $this->assertInstanceof(ClientExtension::class, $obj);
    }


    public function testFromJsonRequestableScopesEnabledValidValue()
    {
        $json = '{"requestableScopesEnabled":true}';
        $obj  = ClientExtension::fromJson($json);

        $this->assertEquals(true, $obj->isRequestableScopesEnabled());
    }


    public function testFromJsonRequestableScopesEnabledValidNull()
    {
        $json = '{"requestableScopesEnabled":null}';
        $obj  = ClientExtension::fromJson($json);

        $this->assertFalse($obj->isRequestableScopesEnabled());
    }


    public function testFromJsonRequestableScopesEnabledValidStringTrue()
    {
        $json = '{"requestableScopesEnabled":"true"}';
        $obj  = ClientExtension::fromJson($json);

        $this->assertTrue($obj->isRequestableScopesEnabled());
    }


    public function testFromJsonRequestableScopesEnabledValidStringFalse()
    {
        $json = '{"requestableScopesEnabled":"false"}';
        $obj  = ClientExtension::fromJson($json);

        $this->assertFalse($obj->isRequestableScopesEnabled());
    }


    public function testFromJsonRequestableScopesEnabledInvalidString()
    {
        $json = '{"requestableScopesEnabled":"__INVALID__"}';
        $obj  = ClientExtension::fromJson($json);

        $this->assertFalse($obj->isRequestableScopesEnabled());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestableScopesEnabledInvalidType()
    {
        $json = '{"requestableScopesEnabled":["a","b"]}';
        $obj  = ClientExtension::fromJson($json);
    }


    public function testFromJsonRequestableScopesValidValue()
    {
        $json = '{"requestableScopes":["scope0","scope1"]}';
        $obj  = ClientExtension::fromJson($json);

        $scopes = $obj->getRequestableScopes();

        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);
        $this->assertEquals('scope0', $scopes[0]);
        $this->assertEquals('scope1', $scopes[1]);
    }


    public function testFromJsonRequestableScopesValidNull()
    {
        $json = '{"requestableScopes":null}';
        $obj  = ClientExtension::fromJson($json);

        $this->assertNull($obj->getRequestableScopes());
    }


    /** @expectedException Error */
    public function testFromJsonRequestableScopesInvalidBool()
    {
        $json = '{"requestableScopes":true}';
        $obj  = ClientExtension::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonRequestableScopesInvalidNumber()
    {
        $json = '{"requestableScopes":123}';
        $obj  = ClientExtension::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new ClientExtension();
        $obj->setRequestableScopesEnabled(true)
            ->setRequestableScopes(array('scope0', 'scope1'))
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // requestableScopesEnabled
        $this->assertArrayHasKey('requestableScopesEnabled', $array);
        $this->assertEquals(true, $array['requestableScopesEnabled']);

        // requestableScopes
        $this->assertArrayHasKey('requestableScopes', $array);

        $scopes = $array['requestableScopes'];
        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);
        $this->assertEquals('scope0', $scopes[0]);
        $this->assertEquals('scope1', $scopes[1]);
    }
}
?>
