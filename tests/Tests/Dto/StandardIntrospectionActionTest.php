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
use Authlete\Dto\StandardIntrospectionAction;


class StandardIntrospectionActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = StandardIntrospectionAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = StandardIntrospectionAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, StandardIntrospectionAction::valueOf($action));
        $this->assertSame($action, StandardIntrospectionAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = StandardIntrospectionAction::$BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name());
    }


    public function testValueOfBadRequest()
    {
        $action = StandardIntrospectionAction::$BAD_REQUEST;

        $this->assertSame($action, StandardIntrospectionAction::valueOf($action));
        $this->assertSame($action, StandardIntrospectionAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfOK()
    {
        $action = StandardIntrospectionAction::$OK;

        $this->assertEquals('OK', $action->name());
    }


    public function testValueOfOK()
    {
        $action = StandardIntrospectionAction::$OK;

        $this->assertSame($action, StandardIntrospectionAction::valueOf($action));
        $this->assertSame($action, StandardIntrospectionAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(StandardIntrospectionAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        StandardIntrospectionAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        StandardIntrospectionAction::valueOf(array());
    }
}
?>
