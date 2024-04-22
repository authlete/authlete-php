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



use Authlete\Dto\BackchannelAuthenticationFailReason;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Types\EnumTestCase;


class BackchannelAuthenticationFailReasonTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::EXPIRED_LOGIN_HINT_TOKEN'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::UNKNOWN_USER_ID'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::UNAUTHORIZED_CLIENT'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::MISSING_USER_CODE'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::INVALID_USER_CODE'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::INVALID_BINDING_MESSAGE'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::INVALID_TARGET'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::ACCESS_DENIED'));
        $this->assertTrue(defined(BackchannelAuthenticationFailReason::class . '::SERVER_ERROR'));
    }

    public function testEnumValues()
    {
        $this->assertSame('EXPIRED_LOGIN_HINT_TOKEN', BackchannelAuthenticationFailReason::EXPIRED_LOGIN_HINT_TOKEN->value);
        $this->assertSame('UNKNOWN_USER_ID', BackchannelAuthenticationFailReason::UNKNOWN_USER_ID->value);
        $this->assertSame('UNAUTHORIZED_CLIENT', BackchannelAuthenticationFailReason::UNAUTHORIZED_CLIENT->value);
        $this->assertSame('MISSING_USER_CODE', BackchannelAuthenticationFailReason::MISSING_USER_CODE->value);
        $this->assertSame('INVALID_USER_CODE', BackchannelAuthenticationFailReason::INVALID_USER_CODE->value);
        $this->assertSame('INVALID_BINDING_MESSAGE', BackchannelAuthenticationFailReason::INVALID_BINDING_MESSAGE->value);
        $this->assertSame('INVALID_TARGET', BackchannelAuthenticationFailReason::INVALID_TARGET->value);
        $this->assertSame('ACCESS_DENIED', BackchannelAuthenticationFailReason::ACCESS_DENIED->value);
        $this->assertSame('SERVER_ERROR', BackchannelAuthenticationFailReason::SERVER_ERROR->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(BackchannelAuthenticationFailReason::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }

}
