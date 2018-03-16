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
use Authlete\Dto\TokenUpdateAction;


class TokenUpdateActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = TokenUpdateAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = TokenUpdateAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, TokenUpdateAction::valueOf($action));
        $this->assertSame($action, TokenUpdateAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = TokenUpdateAction::$BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name());
    }


    public function testValueOfBadRequest()
    {
        $action = TokenUpdateAction::$BAD_REQUEST;

        $this->assertSame($action, TokenUpdateAction::valueOf($action));
        $this->assertSame($action, TokenUpdateAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfForbidden()
    {
        $action = TokenUpdateAction::$FORBIDDEN;

        $this->assertEquals('FORBIDDEN', $action->name());
    }


    public function testValueOfPForbidden()
    {
        $action = TokenUpdateAction::$FORBIDDEN;

        $this->assertSame($action, TokenUpdateAction::valueOf($action));
        $this->assertSame($action, TokenUpdateAction::valueOf('FORBIDDEN'));
    }


    public function testNameOfNotFound()
    {
        $action = TokenUpdateAction::$NOT_FOUND;

        $this->assertEquals('NOT_FOUND', $action->name());
    }


    public function testValueOfNotFound()
    {
        $action = TokenUpdateAction::$NOT_FOUND;

        $this->assertSame($action, TokenUpdateAction::valueOf($action));
        $this->assertSame($action, TokenUpdateAction::valueOf('NOT_FOUND'));
    }


    public function testNameOfOK()
    {
        $action = TokenUpdateAction::$OK;

        $this->assertEquals('OK', $action->name());
    }


    public function testValueOfOK()
    {
        $action = TokenUpdateAction::$OK;

        $this->assertSame($action, TokenUpdateAction::valueOf($action));
        $this->assertSame($action, TokenUpdateAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(TokenUpdateAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        TokenUpdateAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        TokenUpdateAction::valueOf(array());
    }
}
?>
