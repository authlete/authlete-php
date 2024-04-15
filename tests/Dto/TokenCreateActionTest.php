<?php
//
// Copyright (C) 2018 Authlete, Inc.
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



use Authlete\Dto\TokenCreateAction;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class TokenCreateActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = TokenCreateAction::INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name);
    }


    public function testValueOfInternalServerError()
    {
        $action = TokenCreateAction::INTERNAL_SERVER_ERROR;

        $this->assertSame($action, TokenCreateAction::valueOf($action->value));
        $this->assertSame($action, TokenCreateAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = TokenCreateAction::BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name);
    }


    public function testValueOfBadRequest()
    {
        $action = TokenCreateAction::BAD_REQUEST;

        $this->assertSame($action, TokenCreateAction::valueOf($action->value));
        $this->assertSame($action, TokenCreateAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfForbidden()
    {
        $action = TokenCreateAction::FORBIDDEN;

        $this->assertEquals('FORBIDDEN', $action->name);
    }


    public function testValueOfPForbidden()
    {
        $action = TokenCreateAction::FORBIDDEN;

        $this->assertSame($action, TokenCreateAction::valueOf($action->value));
        $this->assertSame($action, TokenCreateAction::valueOf('FORBIDDEN'));
    }


    public function testNameOfOK()
    {
        $action = TokenCreateAction::OK;

        $this->assertEquals('OK', $action->name);
    }


    public function testValueOfOK()
    {
        $action = TokenCreateAction::OK;

        $this->assertSame($action, TokenCreateAction::valueOf($action->value));
        $this->assertSame($action, TokenCreateAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(TokenCreateAction::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        TokenCreateAction::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        TokenCreateAction::valueOf(array());
    }
}
