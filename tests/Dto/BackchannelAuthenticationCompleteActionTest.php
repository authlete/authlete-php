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



use Authlete\Dto\BackchannelAuthenticationCompleteAction;
use PHPUnit\Framework\TestCase;


class BackchannelAuthenticationCompleteActionTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(BackchannelAuthenticationCompleteAction::class . '::NOTIFICATION'));
        $this->assertTrue(defined(BackchannelAuthenticationCompleteAction::class . '::NO_ACTION'));
        $this->assertTrue(defined(BackchannelAuthenticationCompleteAction::class . '::SERVER_ERROR'));
    }

    public function testEnumValues()
    {
        $this->assertSame('NOTIFICATION', BackchannelAuthenticationCompleteAction::NOTIFICATION->value);
        $this->assertSame('NO_ACTION', BackchannelAuthenticationCompleteAction::NO_ACTION->value);
        $this->assertSame('SERVER_ERROR', BackchannelAuthenticationCompleteAction::SERVER_ERROR->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(BackchannelAuthenticationCompleteAction::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }

}

