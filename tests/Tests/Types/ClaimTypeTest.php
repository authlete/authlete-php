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


namespace Authlete\Tests\Types;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Types\ClaimType;


class ClaimTypeTest extends TestCase
{
    public function testNameOfNormal()
    {
        $obj = ClaimType::$NORMAL;

        $this->assertEquals('NORMAL', $obj->name());
    }


    public function testValueOfNormal()
    {
        $obj = ClaimType::$NORMAL;

        $this->assertSame($obj, ClaimType::valueOf($obj));
        $this->assertSame($obj, ClaimType::valueOf('NORMAL'));
    }


    public function testNameOfAggregated()
    {
        $obj = ClaimType::$AGGREGATED;

        $this->assertEquals('AGGREGATED', $obj->name());
    }


    public function testValueOfAggregated()
    {
        $obj = ClaimType::$AGGREGATED;

        $this->assertSame($obj, ClaimType::valueOf($obj));
        $this->assertSame($obj, ClaimType::valueOf('AGGREGATED'));
    }


    public function testNameOfDistributed()
    {
        $obj = ClaimType::$DISTRIBUTED;

        $this->assertEquals('DISTRIBUTED', $obj->name());
    }


    public function testValueOfDistributed()
    {
        $obj = ClaimType::$DISTRIBUTED;

        $this->assertSame($obj, ClaimType::valueOf($obj));
        $this->assertSame($obj, ClaimType::valueOf('DISTRIBUTED'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(ClaimType::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        ClaimType::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        ClaimType::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new ClaimType('NEW');
    }
}
?>
