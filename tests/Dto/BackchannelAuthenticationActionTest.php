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



use Authlete\Dto\BackchannelAuthenticationAction;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Types\EnumTestCase;


class BackchannelAuthenticationActionTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(BackchannelAuthenticationAction::class . '::BAD_REQUEST'));
        $this->assertTrue(defined(BackchannelAuthenticationAction::class . '::UNAUTHORIZED'));
        $this->assertTrue(defined(BackchannelAuthenticationAction::class . '::INTERNAL_SERVER_ERROR'));
        $this->assertTrue(defined(BackchannelAuthenticationAction::class . '::USER_IDENTIFICATION'));
    }

    public function testEnumValues()
    {
        $this->assertSame('BAD_REQUEST', BackchannelAuthenticationAction::BAD_REQUEST->value);
        $this->assertSame('UNAUTHORIZED', BackchannelAuthenticationAction::UNAUTHORIZED->value);
        $this->assertSame('INTERNAL_SERVER_ERROR', BackchannelAuthenticationAction::INTERNAL_SERVER_ERROR->value);
        $this->assertSame('USER_IDENTIFICATION', BackchannelAuthenticationAction::USER_IDENTIFICATION->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(BackchannelAuthenticationAction::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }
}

