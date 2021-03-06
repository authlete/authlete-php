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
use Authlete\Types\Display;


class DisplayTest extends TestCase
{
    public function testNameOfPage()
    {
        $obj = Display::$PAGE;

        $this->assertEquals('PAGE', $obj->name());
    }


    public function testValueOfPage()
    {
        $obj = Display::$PAGE;

        $this->assertSame($obj, Display::valueOf($obj));
        $this->assertSame($obj, Display::valueOf('PAGE'));
    }


    public function testNameOfPopup()
    {
        $obj = Display::$POPUP;

        $this->assertEquals('POPUP', $obj->name());
    }


    public function testValueOfPopup()
    {
        $obj = Display::$POPUP;

        $this->assertSame($obj, Display::valueOf($obj));
        $this->assertSame($obj, Display::valueOf('POPUP'));
    }


    public function testNameOfTouch()
    {
        $obj = Display::$TOUCH;

        $this->assertEquals('TOUCH', $obj->name());
    }


    public function testValueOfTouch()
    {
        $obj = Display::$TOUCH;

        $this->assertSame($obj, Display::valueOf($obj));
        $this->assertSame($obj, Display::valueOf('TOUCH'));
    }


    public function testNameOfWap()
    {
        $obj = Display::$WAP;

        $this->assertEquals('WAP', $obj->name());
    }


    public function testValueOfWap()
    {
        $obj = Display::$WAP;

        $this->assertSame($obj, Display::valueOf($obj));
        $this->assertSame($obj, Display::valueOf('WAP'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(Display::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        Display::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        Display::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new Display('NEW');
    }
}
?>
