<?php
//
// Copyright (C) 2020 Authlete, Inc.
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


namespace Tests\Dto;



use Authlete\Dto\BackchannelAuthenticationFailAction;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Types\EnumTestCase;


class BackchannelAuthenticationFailActionTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(BackchannelAuthenticationFailAction::class . '::BAD_REQUEST'));
        $this->assertTrue(defined(BackchannelAuthenticationFailAction::class . '::FORBIDDEN'));
        $this->assertTrue(defined(BackchannelAuthenticationFailAction::class . '::INTERNAL_SERVER_ERROR'));
    }

    public function testEnumValues()
    {
        $this->assertSame('BAD_REQUEST', BackchannelAuthenticationFailAction::BAD_REQUEST->value);
        $this->assertSame('FORBIDDEN', BackchannelAuthenticationFailAction::FORBIDDEN->value);
        $this->assertSame('INTERNAL_SERVER_ERROR', BackchannelAuthenticationFailAction::INTERNAL_SERVER_ERROR->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(BackchannelAuthenticationFailAction::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }

    // Additional tests specific to your application's requirements can be added here.
}