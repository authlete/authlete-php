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


use Authlete\Dto\BackchannelAuthenticationFailAction;
use Authlete\Tests\Types\EnumTestCase;


class BackchannelAuthenticationFailActionTest extends EnumTestCase
{
    function __construct()
    {
        parent::__construct(BackchannelAuthenticationFailAction::class);
    }


    public function testValues()
    {
        $cls = $this->getTargetClass();

        $this->enumTest($cls::$BAD_REQUEST,           'BAD_REQUEST');
        $this->enumTest($cls::$FORBIDDEN,             'FORBIDDEN');
        $this->enumTest($cls::$INTERNAL_SERVER_ERROR, 'INTERNAL_SERVER_ERROR');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        $this->enumTestInvalidValue();
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        $this->enumTestInvalidArray();
    }
}
?>
