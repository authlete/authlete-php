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


namespace Authlete\Tests\Dto;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Dto\TokenIssueAction;


class TokenIssueActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = TokenIssueAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = TokenIssueAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, TokenIssueAction::valueOf($action));
        $this->assertSame($action, TokenIssueAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfOK()
    {
        $action = TokenIssueAction::$OK;

        $this->assertEquals('OK', $action->name());
    }


    public function testValueOfOK()
    {
        $action = TokenIssueAction::$OK;

        $this->assertSame($action, TokenIssueAction::valueOf($action));
        $this->assertSame($action, TokenIssueAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(TokenIssueAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        TokenIssueAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        TokenIssueAction::valueOf(array());
    }
}
?>
