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



use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Authlete\Dto\AuthorizationIssueAction;


class AuthorizationIssueActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = AuthorizationIssueAction::INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name);
    }


    public function testValueOfInternalServerError()
    {
        $action = AuthorizationIssueAction::INTERNAL_SERVER_ERROR;

        $this->assertSame($action, AuthorizationIssueAction::valueOf($action->name));
        $this->assertSame($action, AuthorizationIssueAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = AuthorizationIssueAction::BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name);
    }


    public function testValueOfBadRequest()
    {
        $action = AuthorizationIssueAction::BAD_REQUEST;

        $this->assertSame($action, AuthorizationIssueAction::valueOf($action->name));
        $this->assertSame($action, AuthorizationIssueAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfLocation()
    {
        $action = AuthorizationIssueAction::LOCATION;

        $this->assertEquals('LOCATION', $action->name);
    }


    public function testValueOfLocation()
    {
        $action = AuthorizationIssueAction::LOCATION;

        $this->assertSame($action, AuthorizationIssueAction::valueOf($action->name));
        $this->assertSame($action, AuthorizationIssueAction::valueOf('LOCATION'));
    }


    public function testNameOfForm()
    {
        $action = AuthorizationIssueAction::FORM;

        $this->assertEquals('FORM', $action->name);
    }


    public function testValueOfForm()
    {
        $action = AuthorizationIssueAction::FORM;

        $this->assertSame($action, AuthorizationIssueAction::valueOf($action->name));
        $this->assertSame($action, AuthorizationIssueAction::valueOf('FORM'));
    }


    public function testValueOfNull()
    {
        $this->expectException(\TypeError::class);
        $this->assertNull(AuthorizationIssueAction::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        AuthorizationIssueAction::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        AuthorizationIssueAction::valueOf(array());
    }
}
