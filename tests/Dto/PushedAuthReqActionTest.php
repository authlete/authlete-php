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



use Authlete\Dto\PushedAuthReqAction;
use PHPUnit\Framework\TestCase;


class PushedAuthReqActionTest extends TestCase
{
    public function testEnumCasesExist()
    {
        $this->assertTrue(defined(PushedAuthReqAction::class . '::CREATED'));
        $this->assertTrue(defined(PushedAuthReqAction::class . '::BAD_REQUEST'));
        $this->assertTrue(defined(PushedAuthReqAction::class . '::UNAUTHORIZED'));
        $this->assertTrue(defined(PushedAuthReqAction::class . '::FORBIDDEN'));
        $this->assertTrue(defined(PushedAuthReqAction::class . '::PAYLOAD_TOO_LARGE'));
        $this->assertTrue(defined(PushedAuthReqAction::class . '::INTERNAL_SERVER_ERROR'));
    }

    public function testEnumValues()
    {
        $this->assertSame('CREATED', PushedAuthReqAction::CREATED->value);
        $this->assertSame('BAD_REQUEST', PushedAuthReqAction::BAD_REQUEST->value);
        $this->assertSame('UNAUTHORIZED', PushedAuthReqAction::UNAUTHORIZED->value);
        $this->assertSame('FORBIDDEN', PushedAuthReqAction::FORBIDDEN->value);
        $this->assertSame('PAYLOAD_TOO_LARGE', PushedAuthReqAction::PAYLOAD_TOO_LARGE->value);
        $this->assertSame('INTERNAL_SERVER_ERROR', PushedAuthReqAction::INTERNAL_SERVER_ERROR->value);
    }

    public function testImplementsValuableInterface()
    {
        $reflect = new \ReflectionClass(PushedAuthReqAction::class);
        $this->assertTrue($reflect->implementsInterface('Authlete\Types\Valuable'));
    }

}

