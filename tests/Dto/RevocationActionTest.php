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



use Authlete\Dto\RevocationAction;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class RevocationActionTest extends TestCase
{
    public function testNameOfInvalidClient()
    {
        $action = RevocationAction::INVALID_CLIENT;

        $this->assertEquals('INVALID_CLIENT', $action->name);
    }


    public function testValueOfInvalidClient()
    {
        $action = RevocationAction::INVALID_CLIENT;

        $this->assertSame($action, RevocationAction::valueOf($action->value));
        $this->assertSame($action, RevocationAction::valueOf('INVALID_CLIENT'));
    }


    public function testNameOfInternalServerError()
    {
        $action = RevocationAction::INTERNAL_SERVER_ERROR;

        $this->assertEquals('INTERNAL_SERVER_ERROR', $action->name);
    }


    public function testValueOfInternalServerError()
    {
        $action = RevocationAction::INTERNAL_SERVER_ERROR;

        $this->assertSame($action, RevocationAction::valueOf($action->value));
        $this->assertSame($action, RevocationAction::valueOf('INTERNAL_SERVER_ERROR'));
    }


    public function testNameOfBadRequest()
    {
        $action = RevocationAction::BAD_REQUEST;

        $this->assertEquals('BAD_REQUEST', $action->name);
    }


    public function testValueOfBadRequest()
    {
        $action = RevocationAction::BAD_REQUEST;

        $this->assertSame($action, RevocationAction::valueOf($action->value));
        $this->assertSame($action, RevocationAction::valueOf('BAD_REQUEST'));
    }


    public function testNameOfOK()
    {
        $action = RevocationAction::OK;

        $this->assertEquals('OK', $action->name);
    }


    public function testValueOfOK()
    {
        $action = RevocationAction::OK;

        $this->assertSame($action, RevocationAction::valueOf($action->value));
        $this->assertSame($action, RevocationAction::valueOf('OK'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(RevocationAction::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        RevocationAction::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        RevocationAction::valueOf(array());
    }
}