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
use Authlete\Dto\TokenFailAction;


class TokenFailActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = TokenFailAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = TokenFailAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, TokenFailAction::valueOf($action));
        $this->assertSame($action, TokenFailAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = TokenFailAction::$BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name());
    }


    public function testValueOfBadRequest()
    {
        $action = TokenFailAction::$BAD_REQUEST;

        $this->assertSame($action, TokenFailAction::valueOf($action));
        $this->assertSame($action, TokenFailAction::valueOf('BAD_REQUEST'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(TokenFailAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        TokenFailAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        TokenFailAction::valueOf(array());
    }
}
?>
