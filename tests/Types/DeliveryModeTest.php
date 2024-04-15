<?php
//
// Copyright (C) 2020 Authlete, Inc.
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



use Authlete\Types\DeliveryMode;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class DeliveryModeTest extends TestCase
{
    public function testNameOfPoll()
    {
        $obj = DeliveryMode::POLL;

        $this->assertEquals('POLL', $obj->name);
    }


    public function testValueOfPoll()
    {
        $obj = DeliveryMode::POLL;

        $this->assertSame($obj, DeliveryMode::valueOf($obj->value));
        $this->assertSame($obj, DeliveryMode::valueOf('POLL'));
    }


    public function testNameOfPing()
    {
        $obj = DeliveryMode::PING;

        $this->assertEquals('PING', $obj->name);
    }


    public function testValueOfPing()
    {
        $obj = DeliveryMode::PING;

        $this->assertSame($obj, DeliveryMode::valueOf($obj->value));
        $this->assertSame($obj, DeliveryMode::valueOf('PING'));
    }


    public function testNameOfPush()
    {
        $obj = DeliveryMode::PUSH;

        $this->assertEquals('PUSH', $obj->name);
    }


    public function testValueOfPush()
    {
        $obj = DeliveryMode::PUSH;

        $this->assertSame($obj, DeliveryMode::valueOf($obj->value));
        $this->assertSame($obj, DeliveryMode::valueOf('PUSH'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(DeliveryMode::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        DeliveryMode::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        DeliveryMode::valueOf(array());
    }


    public function testInstantiation()
    {
        $this->expectException(InvalidArgumentException::class);
        DeliveryMode::valueOf('NEW');
    }
}

