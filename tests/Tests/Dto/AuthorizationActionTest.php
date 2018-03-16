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
use Authlete\Dto\AuthorizationAction;


class AuthorizationActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = AuthorizationAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = AuthorizationAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, AuthorizationAction::valueOf($action));
        $this->assertSame($action, AuthorizationAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = AuthorizationAction::$BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name());
    }


    public function testValueOfBadRequest()
    {
        $action = AuthorizationAction::$BAD_REQUEST;

        $this->assertSame($action, AuthorizationAction::valueOf($action));
        $this->assertSame($action, AuthorizationAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfLocation()
    {
        $action = AuthorizationAction::$LOCATION;

        $this->assertEquals('LOCATION', $action->name());
    }


    public function testValueOfLocation()
    {
        $action = AuthorizationAction::$LOCATION;

        $this->assertSame($action, AuthorizationAction::valueOf($action));
        $this->assertSame($action, AuthorizationAction::valueOf('LOCATION'));
    }


    public function testNameOfForm()
    {
        $action = AuthorizationAction::$FORM;

        $this->assertEquals('FORM', $action->name());
    }


    public function testValueOfForm()
    {
        $action = AuthorizationAction::$FORM;

        $this->assertSame($action, AuthorizationAction::valueOf($action));
        $this->assertSame($action, AuthorizationAction::valueOf('FORM'));
    }


    public function testNameOfNoInteraction()
    {
        $action = AuthorizationAction::$NO_INTERACTION;

        $this->assertEquals('NO_INTERACTION', $action->name());
    }


    public function testValueOfNoInteraction()
    {
        $action = AuthorizationAction::$NO_INTERACTION;

        $this->assertSame($action, AuthorizationAction::valueOf($action));
        $this->assertSame($action, AuthorizationAction::valueOf('NO_INTERACTION'));
    }


    public function testNameOfInteraction()
    {
        $action = AuthorizationAction::$INTERACTION;

        $this->assertEquals('INTERACTION', $action->name());
    }


    public function testValueOfInteraction()
    {
        $action = AuthorizationAction::$INTERACTION;

        $this->assertSame($action, AuthorizationAction::valueOf($action));
        $this->assertSame($action, AuthorizationAction::valueOf('INTERACTION'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(AuthorizationAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        AuthorizationAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        AuthorizationAction::valueOf(array());
    }
}
?>
