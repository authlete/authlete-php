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


namespace Authlete\Tests\Types;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Types\ClientAuthMethod;


class ClientAuthMethodTest extends TestCase
{
    public function testNameOfNone()
    {
        $obj = ClientAuthMethod::$NONE;

        $this->assertEquals('NONE', $obj->name());
    }


    public function testValueOfNone()
    {
        $obj = ClientAuthMethod::$NONE;

        $this->assertSame($obj, ClientAuthMethod::valueOf($obj));
        $this->assertSame($obj, ClientAuthMethod::valueOf('NONE'));
    }


    public function testNameOfClientSecretBasic()
    {
        $obj = ClientAuthMethod::$CLIENT_SECRET_BASIC;

        $this->assertEquals('CLIENT_SECRET_BASIC', $obj->name());
    }


    public function testValueOfClientSecretBasic()
    {
        $obj = ClientAuthMethod::$CLIENT_SECRET_BASIC;

        $this->assertSame($obj, ClientAuthMethod::valueOf($obj));
        $this->assertSame($obj, ClientAuthMethod::valueOf('CLIENT_SECRET_BASIC'));
    }


    public function testNameOfClientSecretPost()
    {
        $obj = ClientAuthMethod::$CLIENT_SECRET_POST;

        $this->assertEquals('CLIENT_SECRET_POST', $obj->name());
    }


    public function testValueOfClientSecretPost()
    {
        $obj = ClientAuthMethod::$CLIENT_SECRET_POST;

        $this->assertSame($obj, ClientAuthMethod::valueOf($obj));
        $this->assertSame($obj, ClientAuthMethod::valueOf('CLIENT_SECRET_POST'));
    }


    public function testNameOfClientSecretJwt()
    {
        $obj = ClientAuthMethod::$CLIENT_SECRET_JWT;

        $this->assertEquals('CLIENT_SECRET_JWT', $obj->name());
    }


    public function testValueOfClientSecretJwt()
    {
        $obj = ClientAuthMethod::$CLIENT_SECRET_JWT;

        $this->assertSame($obj, ClientAuthMethod::valueOf($obj));
        $this->assertSame($obj, ClientAuthMethod::valueOf('CLIENT_SECRET_JWT'));
    }


    public function testNameOfPrivateKeyJwt()
    {
        $obj = ClientAuthMethod::$PRIVATE_KEY_JWT;

        $this->assertEquals('PRIVATE_KEY_JWT', $obj->name());
    }


    public function testValueOfPrivateKeyJwt()
    {
        $obj = ClientAuthMethod::$PRIVATE_KEY_JWT;

        $this->assertSame($obj, ClientAuthMethod::valueOf($obj));
        $this->assertSame($obj, ClientAuthMethod::valueOf('PRIVATE_KEY_JWT'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(ClientAuthMethod::valueOf(null));
    }


    public function testNameOfTlsClientAuth()
    {
        $obj = ClientAuthMethod::$TLS_CLIENT_AUTH;

        $this->assertEquals('TLS_CLIENT_AUTH', $obj->name());
    }


    public function testValueOfTlsClientAuth()
    {
        $obj = ClientAuthMethod::$TLS_CLIENT_AUTH;

        $this->assertSame($obj, ClientAuthMethod::valueOf($obj));
        $this->assertSame($obj, ClientAuthMethod::valueOf('TLS_CLIENT_AUTH'));
    }


    public function testNameOfSelfSignedTlsClientAuth()
    {
        $obj = ClientAuthMethod::$SELF_SIGNED_TLS_CLIENT_AUTH;

        $this->assertEquals('SELF_SIGNED_TLS_CLIENT_AUTH', $obj->name());
    }


    public function testValueOfSelfSignedTlsClientAuth()
    {
        $obj = ClientAuthMethod::$SELF_SIGNED_TLS_CLIENT_AUTH;

        $this->assertSame($obj, ClientAuthMethod::valueOf($obj));
        $this->assertSame($obj, ClientAuthMethod::valueOf('SELF_SIGNED_TLS_CLIENT_AUTH'));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        ClientAuthMethod::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        ClientAuthMethod::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new ClientAuthMethod('NEW');
    }
}
?>
