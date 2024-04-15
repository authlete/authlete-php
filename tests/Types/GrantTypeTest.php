<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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


namespace Tests\Types;



use Authlete\Types\GrantType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class GrantTypeTest extends TestCase
{
    public function testNameOfAuthorizationCode()
    {
        $obj = GrantType::AUTHORIZATION_CODE;

        $this->assertEquals('AUTHORIZATION_CODE', $obj->name);
    }


    public function testValueOfAuthorizationCode()
    {
        $obj = GrantType::AUTHORIZATION_CODE;

        $this->assertSame($obj, GrantType::valueOf($obj->value));
        $this->assertSame($obj, GrantType::valueOf('AUTHORIZATION_CODE'));
    }


    public function testNameOfImplicit()
    {
        $obj = GrantType::IMPLICIT;

        $this->assertEquals('IMPLICIT', $obj->name);
    }


    public function testValueOfImplicit()
    {
        $obj = GrantType::IMPLICIT;

        $this->assertSame($obj, GrantType::valueOf($obj->value));
        $this->assertSame($obj, GrantType::valueOf('IMPLICIT'));
    }


    public function testNameOfPassword()
    {
        $obj = GrantType::PASSWORD;

        $this->assertEquals('PASSWORD', $obj->name);
    }


    public function testValueOfPassword()
    {
        $obj = GrantType::PASSWORD;

        $this->assertSame($obj, GrantType::valueOf($obj->value));
        $this->assertSame($obj, GrantType::valueOf('PASSWORD'));
    }


    public function testNameOfClientCredentials()
    {
        $obj = GrantType::CLIENT_CREDENTIALS;

        $this->assertEquals('CLIENT_CREDENTIALS', $obj->name);
    }


    public function testValueOfClientCredentials()
    {
        $obj = GrantType::CLIENT_CREDENTIALS;

        $this->assertSame($obj, GrantType::valueOf($obj->value));
        $this->assertSame($obj, GrantType::valueOf('CLIENT_CREDENTIALS'));
    }


    public function testNameOfRefreshToken()
    {
        $obj = GrantType::REFRESH_TOKEN;

        $this->assertEquals('REFRESH_TOKEN', $obj->name);
    }


    public function testValueOfRefreshToken()
    {
        $obj = GrantType::REFRESH_TOKEN;

        $this->assertSame($obj, GrantType::valueOf($obj->value));
        $this->assertSame($obj, GrantType::valueOf('REFRESH_TOKEN'));
    }


    public function testNameOfCiba()
    {
        $obj = GrantType::CIBA;

        $this->assertEquals('CIBA', $obj->name);
    }


    public function testValueOfCiba()
    {
        $obj = GrantType::CIBA;

        $this->assertSame($obj, GrantType::valueOf($obj->value));
        $this->assertSame($obj, GrantType::valueOf('CIBA'));
    }


    public function testNameOfDeviceCode()
    {
        $obj = GrantType::DEVICE_CODE;

        $this->assertEquals('DEVICE_CODE', $obj->name);
    }


    public function testValueOfDeviceCode()
    {
        $obj = GrantType::DEVICE_CODE;

        $this->assertSame($obj, GrantType::valueOf($obj->value));
        $this->assertSame($obj, GrantType::valueOf('DEVICE_CODE'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(GrantType::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        GrantType::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        GrantType::valueOf(array());
    }


    public function testInstantiation()
    {
        $this->expectException(InvalidArgumentException::class);
        GrantType::valueOf('NEW');
    }
}
