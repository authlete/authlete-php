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
use Authlete\Types\ApplicationType;


class ApplicationTypeTest extends TestCase
{
    public function testNameOfWeb()
    {
        $obj = ApplicationType::$WEB;

        $this->assertEquals('WEB', $obj->name());
    }


    public function testValueOfWeb()
    {
        $obj = ApplicationType::$WEB;

        $this->assertSame($obj, ApplicationType::valueOf($obj));
        $this->assertSame($obj, ApplicationType::valueOf('WEB'));
    }


    public function testNameOfNative()
    {
        $obj = ApplicationType::$NATIVE;

        $this->assertEquals('NATIVE', $obj->name());
    }


    public function testValueOfNative()
    {
        $obj = ApplicationType::$NATIVE;

        $this->assertSame($obj, ApplicationType::valueOf($obj));
        $this->assertSame($obj, ApplicationType::valueOf('NATIVE'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(ApplicationType::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        ApplicationType::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        ApplicationType::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new ApplicationType('NEW');
    }
}
?>
