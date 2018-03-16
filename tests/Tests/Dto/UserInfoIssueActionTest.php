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
use Authlete\Dto\UserInfoIssueAction;


class UserInfoIssueActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = UserInfoIssueAction::$INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name());
    }


    public function testValueOfInternalServerError()
    {
        $action = UserInfoIssueAction::$INTERNAL_SERVER_ERROR;

        $this->assertSame($action, UserInfoIssueAction::valueOf($action));
        $this->assertSame($action, UserInfoIssueAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = UserInfoIssueAction::$BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name());
    }


    public function testValueOfBadRequest()
    {
        $action = UserInfoIssueAction::$BAD_REQUEST;

        $this->assertSame($action, UserInfoIssueAction::valueOf($action));
        $this->assertSame($action, UserInfoIssueAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfUnauthorized()
    {
        $action = UserInfoIssueAction::$UNAUTHORIZED;

        $this->assertEquals('UNAUTHORIZED', $action->name());
    }


    public function testValueOfUnauthorized()
    {
        $action = UserInfoIssueAction::$UNAUTHORIZED;

        $this->assertSame($action, UserInfoIssueAction::valueOf($action));
        $this->assertSame($action, UserInfoIssueAction::valueOf('UNAUTHORIZED'));
    }


    public function testNameOfForbidden()
    {
        $action = UserInfoIssueAction::$FORBIDDEN;

        $this->assertEquals('FORBIDDEN', $action->name());
    }


    public function testValueOfForbidden()
    {
        $action = UserInfoIssueAction::$FORBIDDEN;

        $this->assertSame($action, UserInfoIssueAction::valueOf($action));
        $this->assertSame($action, UserInfoIssueAction::valueOf('FORBIDDEN'));
    }


    public function testNameOfJson()
    {
        $action = UserInfoIssueAction::$JSON;

        $this->assertEquals('JSON', $action->name());
    }


    public function testValueOfJson()
    {
        $action = UserInfoIssueAction::$JSON;

        $this->assertSame($action, UserInfoIssueAction::valueOf($action));
        $this->assertSame($action, UserInfoIssueAction::valueOf('JSON'));
    }


    public function testNameOfJWT()
    {
        $action = UserInfoIssueAction::$JWT;

        $this->assertEquals('JWT', $action->name());
    }


    public function testValueOfJWT()
    {
        $action = UserInfoIssueAction::$JWT;

        $this->assertSame($action, UserInfoIssueAction::valueOf($action));
        $this->assertSame($action, UserInfoIssueAction::valueOf('JWT'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(UserInfoIssueAction::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        UserInfoIssueAction::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        UserInfoIssueAction::valueOf(array());
    }
}
?>
