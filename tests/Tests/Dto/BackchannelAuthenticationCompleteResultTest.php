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


namespace Authlete\Tests\Dto;


require_once('vendor/autoload.php');
require_once('tests/Tests/Types/EnumTestCase.php');


use Authlete\Dto\BackchannelAuthenticationCompleteResult;
use Authlete\Tests\Types\EnumTestCase;
use InvalidArgumentException;


class BackchannelAuthenticationCompleteResultTest extends EnumTestCase
{
    function __construct()
    {
        parent::__construct(BackchannelAuthenticationCompleteResult::class);
    }


    public function testValues()
    {
        $cls = $this->getTargetClass();

        $this->enumTest($cls::$AUTHORIZED,         'AUTHORIZED');
        $this->enumTest($cls::$ACCESS_DENIED,      'ACCESS_DENIED');
        $this->enumTest($cls::$TRANSACTION_FAILED, 'TRANSACTION_FAILED');
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->enumTestInvalidValue();
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->enumTestInvalidArray();
    }
}