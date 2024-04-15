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

use PHPUnit\Framework\TestCase;
use Authlete\Dto\DeviceAuthorizationAction;

class DeviceAuthorizationActionTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(DeviceAuthorizationAction::class . '::OK'));
        $this->assertTrue(defined(DeviceAuthorizationAction::class . '::BAD_REQUEST'));
        $this->assertTrue(defined(DeviceAuthorizationAction::class . '::UNAUTHORIZED'));
        $this->assertTrue(defined(DeviceAuthorizationAction::class . '::INTERNAL_SERVER_ERROR'));
    }

    public function testEnumValues()
    {
        $this->assertSame('OK', DeviceAuthorizationAction::OK->value);
        $this->assertSame('BAD_REQUEST', DeviceAuthorizationAction::BAD_REQUEST->value);
        $this->assertSame('UNAUTHORIZED', DeviceAuthorizationAction::UNAUTHORIZED->value);
        $this->assertSame('INTERNAL_SERVER_ERROR', DeviceAuthorizationAction::INTERNAL_SERVER_ERROR->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(DeviceAuthorizationAction::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }

    public function testUsesEnumTrait()
    {
        $uses = class_uses(DeviceAuthorizationAction::class);
        $this->assertArrayHasKey('Authlete\Types\EnumTrait', $uses);
    }
}
