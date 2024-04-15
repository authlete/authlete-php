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



use Authlete\Dto\UserInfoAction;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class UserInfoActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = UserInfoAction::INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name);
    }


    public function testValueOfInternalServerError()
    {
        $action = UserInfoAction::INTERNAL_SERVER_ERROR;

        $this->assertSame($action, UserInfoAction::valueOf($action->value));
        $this->assertSame($action, UserInfoAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = UserInfoAction::BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name);
    }


    public function testValueOfBadRequest()
    {
        $action = UserInfoAction::BAD_REQUEST;

        $this->assertSame($action, UserInfoAction::valueOf($action->value));
        $this->assertSame($action, UserInfoAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfUnauthorized()
    {
        $action = UserInfoAction::UNAUTHORIZED;

        $this->assertEquals('UNAUTHORIZED', $action->name);
    }


    public function testValueOfUnauthorized()
    {
        $action = UserInfoAction::UNAUTHORIZED;

        $this->assertSame($action, UserInfoAction::valueOf($action->value));
        $this->assertSame($action, UserInfoAction::valueOf('UNAUTHORIZED'));
    }


    public function testNameOfForbidden()
    {
        $action = UserInfoAction::FORBIDDEN;

        $this->assertEquals('FORBIDDEN', $action->name);
    }


    public function testValueOfForbidden()
    {
        $action = UserInfoAction::FORBIDDEN;

        $this->assertSame($action, UserInfoAction::valueOf($action->value));
        $this->assertSame($action, UserInfoAction::valueOf('FORBIDDEN'));
    }


    public function testNameOfOK()
    {
        $action = UserInfoAction::OK;

        $this->assertEquals('OK', $action->name);
    }


    public function testValueOfOK()
    {
        $action = UserInfoAction::OK;

        $this->assertSame($action, UserInfoAction::valueOf($action->value));
        $this->assertSame($action, UserInfoAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(UserInfoAction::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        UserInfoAction::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        UserInfoAction::valueOf(array());
    }
}
