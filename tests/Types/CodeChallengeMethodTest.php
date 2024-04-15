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


namespace Tests\Types;



use InvalidArgumentException;
use Authlete\Types\CodeChallengeMethod;
use PHPUnit\Framework\TestCase;


class CodeChallengeMethodTest extends TestCase
{
    public function testNameOfPlain()
    {
        $obj = CodeChallengeMethod::PLAIN;

        $this->assertEquals('PLAIN', $obj->name);
    }


    public function testValueOfPlain()
    {
        $obj = CodeChallengeMethod::PLAIN;

        $this->assertSame($obj, CodeChallengeMethod::valueOf($obj->value));
        $this->assertSame($obj, CodeChallengeMethod::valueOf('PLAIN'));
    }


    public function testNameOfS256()
    {
        $obj = CodeChallengeMethod::S256;

        $this->assertEquals('S256', $obj->name);
    }


    public function testValueOfS256()
    {
        $obj = CodeChallengeMethod::S256;

        $this->assertSame($obj, CodeChallengeMethod::valueOf($obj->value));
        $this->assertSame($obj, CodeChallengeMethod::valueOf('S256'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(CodeChallengeMethod::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        CodeChallengeMethod::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        CodeChallengeMethod::valueOf(array());
    }


    public function testInstantiation()
    {
        $this->expectException(InvalidArgumentException::class);
        CodeChallengeMethod::valueOf('NEW');
    }
}
