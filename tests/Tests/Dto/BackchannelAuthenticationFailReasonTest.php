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


use Authlete\Dto\BackchannelAuthenticationFailReason;
use Authlete\Tests\Types\EnumTestCase;


class BackchannelAuthenticationFailReasonTest extends EnumTestCase
{
    function __construct()
    {
        parent::__construct(BackchannelAuthenticationFailReason::class);
    }


    public function testValues()
    {
        $cls = $this->getTargetClass();

        $this->enumTest($cls::$EXPIRED_LOGIN_HINT_TOKEN, 'EXPIRED_LOGIN_HINT_TOKEN');
        $this->enumTest($cls::$UNKNOWN_USER_ID,          'UNKNOWN_USER_ID');
        $this->enumTest($cls::$UNAUTHORIZED_CLIENT,      'UNAUTHORIZED_CLIENT');
        $this->enumTest($cls::$MISSING_USER_CODE,        'MISSING_USER_CODE');
        $this->enumTest($cls::$INVALID_USER_CODE,        'INVALID_USER_CODE');
        $this->enumTest($cls::$INVALID_BINDING_MESSAGE,  'INVALID_BINDING_MESSAGE');
        $this->enumTest($cls::$INVALID_TARGET,           'INVALID_TARGET');
        $this->enumTest($cls::$ACCESS_DENIED,            'ACCESS_DENIED');
        $this->enumTest($cls::$SERVER_ERROR,             'SERVER_ERROR');
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
