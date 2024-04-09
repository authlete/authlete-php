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


use Authlete\Dto\DeviceCompleteAction;
use Authlete\Tests\Types\EnumTestCase;
use InvalidArgumentException;


class DeviceCompleteActionTest extends EnumTestCase
{
    function __construct()
    {
        parent::__construct(DeviceCompleteAction::class);
    }


    public function testValues()
    {
        $cls = $this->getTargetClass();

        $this->enumTest($cls::SUCCESS,             'SUCCESS');
        $this->enumTest($cls::INVALID_REQUEST,     'INVALID_REQUEST');
        $this->enumTest($cls::USER_CODE_EXPIRED,   'USER_CODE_EXPIRED');
        $this->enumTest($cls::USER_CODE_NOT_EXIST, 'USER_CODE_NOT_EXIST');
        $this->enumTest($cls::SERVER_ERROR,        'SERVER_ERROR');
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
