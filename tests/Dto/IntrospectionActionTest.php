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



use Authlete\Dto\IntrospectionAction;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class IntrospectionActionTest extends TestCase
{
    public function testNameOfInternalServerError()
    {
        $action = IntrospectionAction::INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name);
    }


    public function testValueOfInternalServerError()
    {
        $action = IntrospectionAction::INTERNAL_SERVER_ERROR;

        $this->assertSame($action, IntrospectionAction::valueOf($action->name));
        $this->assertSame($action, IntrospectionAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = IntrospectionAction::BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name);
    }


    public function testValueOfBadRequest()
    {
        $action = IntrospectionAction::BAD_REQUEST;

        $this->assertSame($action, IntrospectionAction::valueOf($action->name));
        $this->assertSame($action, IntrospectionAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfUnauthorized()
    {
        $action = IntrospectionAction::UNAUTHORIZED;

        $this->assertEquals('UNAUTHORIZED', $action->name);
    }


    public function testValueOfUnauthorized()
    {
        $action = IntrospectionAction::UNAUTHORIZED;

        $this->assertSame($action, IntrospectionAction::valueOf($action->name));
        $this->assertSame($action, IntrospectionAction::valueOf('UNAUTHORIZED'));
    }


    public function testNameOfForbidden()
    {
        $action = IntrospectionAction::FORBIDDEN;

        $this->assertEquals('FORBIDDEN', $action->name);
    }


    public function testValueOfForbidden()
    {
        $action = IntrospectionAction::FORBIDDEN;

        $this->assertSame($action, IntrospectionAction::valueOf($action->name));
        $this->assertSame($action, IntrospectionAction::valueOf('FORBIDDEN'));
    }


    public function testNameOfOK()
    {
        $action = IntrospectionAction::OK;

        $this->assertEquals('OK', $action->name);
    }


    public function testValueOfOK()
    {
        $action = IntrospectionAction::OK;

        $this->assertSame($action, IntrospectionAction::valueOf($action->value));
        $this->assertSame($action, IntrospectionAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(IntrospectionAction::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        IntrospectionAction::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        IntrospectionAction::valueOf(array());
    }
}
