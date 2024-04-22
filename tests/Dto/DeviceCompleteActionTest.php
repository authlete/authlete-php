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



use Authlete\Dto\DeviceCompleteAction;
use PHPUnit\Framework\TestCase;


class DeviceCompleteActionTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(DeviceCompleteAction::class . '::SUCCESS'));
        $this->assertTrue(defined(DeviceCompleteAction::class . '::INVALID_REQUEST'));
        $this->assertTrue(defined(DeviceCompleteAction::class . '::USER_CODE_EXPIRED'));
        $this->assertTrue(defined(DeviceCompleteAction::class . '::USER_CODE_NOT_EXIST'));
        $this->assertTrue(defined(DeviceCompleteAction::class . '::SERVER_ERROR'));
    }

    public function testEnumValues()
    {
        $this->assertSame('SUCCESS', DeviceCompleteAction::SUCCESS->value);
        $this->assertSame('INVALID_REQUEST', DeviceCompleteAction::INVALID_REQUEST->value);
        $this->assertSame('USER_CODE_EXPIRED', DeviceCompleteAction::USER_CODE_EXPIRED->value);
        $this->assertSame('USER_CODE_NOT_EXIST', DeviceCompleteAction::USER_CODE_NOT_EXIST->value);
        $this->assertSame('SERVER_ERROR', DeviceCompleteAction::SERVER_ERROR->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(DeviceCompleteAction::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }

}
