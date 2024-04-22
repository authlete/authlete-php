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


namespace Tests\Util;



use Authlete\Util\MaxAgeValidator;
use PHPUnit\Framework\TestCase;


class MaxAgeValidatorTest extends TestCase
{
    public function testValid()
    {
        $validator = (new MaxAgeValidator())
            ->setAuthenticationTime(5)
            ->setMaxAge(15)
            ->setCurrentTime(15)
            ;
        $this->assertTrue($validator->validate());
    }


    public function testValidWithoutCurrentTime()
    {
        $validator = (new MaxAgeValidator())
            ->setAuthenticationTime(time() - 5)
            ->setMaxAge(15)
            ;

        $this->assertTrue($validator->validate());
    }


    public function testInvalid()
    {
        $validator = (new MaxAgeValidator())
            ->setAuthenticationTime(5)
            ->setMaxAge(15)
            ->setCurrentTime(25)
            ;

        $this->assertFalse($validator->validate());
    }


    public function testInvalidWithoutCurrentTime()
    {
        $validator = (new MaxAgeValidator())
            ->setAuthenticationTime(time() - 15)
            ->setMaxAge(5)
            ;

        $this->assertFalse($validator->validate());
    }
}
