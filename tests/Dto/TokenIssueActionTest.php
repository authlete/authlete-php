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



use Authlete\Dto\TokenIssueAction;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class TokenIssueActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = TokenIssueAction::INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name);
    }


    public function testValueOfInternalServerError()
    {
        $action = TokenIssueAction::INTERNAL_SERVER_ERROR;

        $this->assertSame($action, TokenIssueAction::valueOf($action->value));
        $this->assertSame($action, TokenIssueAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfOK()
    {
        $action = TokenIssueAction::OK;

        $this->assertEquals('OK', $action->name);
    }


    public function testValueOfOK()
    {
        $action = TokenIssueAction::OK;

        $this->assertSame($action, TokenIssueAction::valueOf($action->value));
        $this->assertSame($action, TokenIssueAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(TokenIssueAction::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        TokenIssueAction::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        TokenIssueAction::valueOf(array());
    }
}
