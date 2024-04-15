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



use Authlete\Dto\DeviceCompleteResult;
use PHPUnit\Framework\TestCase;

class DeviceCompleteResultTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(DeviceCompleteResult::class . '::AUTHORIZED'));
        $this->assertTrue(defined(DeviceCompleteResult::class . '::ACCESS_DENIED'));
        $this->assertTrue(defined(DeviceCompleteResult::class . '::TRANSACTION_FAILED'));
    }

    public function testEnumValues()
    {
        $this->assertSame('AUTHORIZED', DeviceCompleteResult::AUTHORIZED->value);
        $this->assertSame('ACCESS_DENIED', DeviceCompleteResult::ACCESS_DENIED->value);
        $this->assertSame('TRANSACTION_FAILED', DeviceCompleteResult::TRANSACTION_FAILED->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(DeviceCompleteResult::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }

    // Additional tests specific to your application's requirements can be added here.
}