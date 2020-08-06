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


namespace Authlete\Tests\Types;


use PHPUnit\Framework\TestCase;


class EnumTestCase extends TestCase
{
    private $targetClass = null;


    function __construct($targetClass)
    {
        parent::__construct();
        $this->targetClass = $targetClass;
    }


    public function getTargetClass()
    {
        return $this->targetClass;
    }


    public function enumTest($instance, $name)
    {
        $this->assertEquals($name, $instance->name());
        $this->assertSame($instance, $this->targetClass::valueOf($instance));
        $this->assertSame($instance, $this->targetClass::valueOf($name));
        $this->assertNull($this->targetClass::valueOf(null));
    }


    public function enumTestInvalidValue()
    {
        $this->targetClass::valueOf('__INVALID_VALUE__');
    }


    public function enumTestInvalidArray()
    {
        $this->targetClass::valueOf(array());
    }
}
?>
