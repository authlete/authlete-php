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


namespace Tests\Dto;;


use Authlete\Dto\BackchannelAuthenticationCompleteResult;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Types\EnumTestCase;


class BackchannelAuthenticationCompleteResultTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(BackchannelAuthenticationCompleteResult::class . '::AUTHORIZED'));
        $this->assertTrue(defined(BackchannelAuthenticationCompleteResult::class . '::ACCESS_DENIED'));
        $this->assertTrue(defined(BackchannelAuthenticationCompleteResult::class . '::TRANSACTION_FAILED'));
    }

    public function testEnumValues()
    {
        $this->assertSame('AUTHORIZED', BackchannelAuthenticationCompleteResult::AUTHORIZED->value);
        $this->assertSame('ACCESS_DENIED', BackchannelAuthenticationCompleteResult::ACCESS_DENIED->value);
        $this->assertSame('TRANSACTION_FAILED', BackchannelAuthenticationCompleteResult::TRANSACTION_FAILED->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(BackchannelAuthenticationCompleteResult::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }
}