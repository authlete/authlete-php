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


namespace Tests\Dto;



use Authlete\Dto\DeviceVerificationRequest;
use PHPUnit\Framework\TestCase;


class DeviceVerificationRequestTest extends TestCase
{
    private const USER_CODE = '_user_code_';


    public function buildObj(): DeviceVerificationRequest
    {
        $obj = new DeviceVerificationRequest();
        $obj->setUserCode(self::USER_CODE)
        ;

        return $obj;
    }


    public function testToJson()
    {
        $obj   = $this->buildObj();
        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // userCode
        $this->assertArrayHasKey('userCode', $array);
        $this->assertEquals(self::USER_CODE, $array['userCode']);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // userCode
        $this->assertEquals(self::USER_CODE, $obj->getUserCode());
    }
}
