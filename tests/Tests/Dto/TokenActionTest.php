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
use Authlete\Dto\TokenAction;


class TokenActionTest extends TestCase
{
    public function testNameOfInvalidClient()
    {
        $action = TokenAction::$INVALID_CLIENT;

        $this->assertEquals('INVALID_CLIENT', $action->name());
    }


    public function testValueOfInvalidClient()
    {
        $action = TokenAction::$INVALID_CLIENT;

        $this->assertSame($action, TokenAction::valueOf($action));
        $this->assertSame($action, TokenAction::valueOf('INVALID_CLIENT'));
    }


    public function testNameOfInternalServerError()
    {
        $action = TokenAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = TokenAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, TokenAction::valueOf($action));
        $this->assertSame($action, TokenAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = TokenAction::$BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name());
    }


    public function testValueOfBadRequest()
    {
        $action = TokenAction::$BAD_REQUEST;

        $this->assertSame($action, TokenAction::valueOf($action));
        $this->assertSame($action, TokenAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfPassword()
    {
        $action = TokenAction::$PASSWORD;

        $this->assertEquals('PASSWORD', $action->name());
    }


    public function testValueOfPassword()
    {
        $action = TokenAction::$PASSWORD;

        $this->assertSame($action, TokenAction::valueOf($action));
        $this->assertSame($action, TokenAction::valueOf('PASSWORD'));
    }


    public function testNameOfOK()
    {
        $action = TokenAction::$OK;

        $this->assertEquals('OK', $action->name());
    }


    public function testValueOfOK()
    {
        $action = TokenAction::$OK;

        $this->assertSame($action, TokenAction::valueOf($action));
        $this->assertSame($action, TokenAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(TokenAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        TokenAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        TokenAction::valueOf(array());
    }
}
?>
