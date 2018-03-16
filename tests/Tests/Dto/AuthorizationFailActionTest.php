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
use Authlete\Dto\AuthorizationFailAction;


class AuthorizationFailActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = AuthorizationFailAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = AuthorizationFailAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, AuthorizationFailAction::valueOf($action));
        $this->assertSame($action, AuthorizationFailAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = AuthorizationFailAction::$BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name());
    }


    public function testValueOfBadRequest()
    {
        $action = AuthorizationFailAction::$BAD_REQUEST;

        $this->assertSame($action, AuthorizationFailAction::valueOf($action));
        $this->assertSame($action, AuthorizationFailAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfLocation()
    {
        $action = AuthorizationFailAction::$LOCATION;

        $this->assertEquals('LOCATION', $action->name());
    }


    public function testValueOfLocation()
    {
        $action = AuthorizationFailAction::$LOCATION;

        $this->assertSame($action, AuthorizationFailAction::valueOf($action));
        $this->assertSame($action, AuthorizationFailAction::valueOf('LOCATION'));
    }


    public function testNameOfForm()
    {
        $action = AuthorizationFailAction::$FORM;

        $this->assertEquals('FORM', $action->name());
    }


    public function testValueOfForm()
    {
        $action = AuthorizationFailAction::$FORM;

        $this->assertSame($action, AuthorizationFailAction::valueOf($action));
        $this->assertSame($action, AuthorizationFailAction::valueOf('FORM'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(AuthorizationFailAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        AuthorizationFailAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        AuthorizationFailAction::valueOf(array());
    }
}
?>
