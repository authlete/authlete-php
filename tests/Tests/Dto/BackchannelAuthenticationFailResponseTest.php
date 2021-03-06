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


use PHPUnit\Framework\TestCase;
use Authlete\Dto\BackchannelAuthenticationFailAction;
use Authlete\Dto\BackchannelAuthenticationFailResponse;


class BackchannelAuthenticationFailResponseTest extends TestCase
{
    private const RESPONSE_CONTENT = '_response_content_';


    public function buildObj()
    {
        $obj = new BackchannelAuthenticationFailResponse();
        $obj->setAction(BackchannelAuthenticationFailAction::$BAD_REQUEST)
            ->setResponseContent(self::RESPONSE_CONTENT)
        ;

        return $obj;
    }


    public function testToJson()
    {
        $obj   = $this->buildObj();
        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // action
        $this->assertArrayHasKey('action', $array);
        $this->assertEquals('BAD_REQUEST', $array['action']);

        // responseContent
        $this->assertArrayHasKey('responseContent', $array);
        $this->assertEquals(self::RESPONSE_CONTENT, $array['responseContent']);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // action
        $this->assertEquals(BackchannelAuthenticationFailAction::$BAD_REQUEST, $obj->getAction());

        // responseContent
        $this->assertEquals(self::RESPONSE_CONTENT, $obj->getResponseContent());
    }
}
?>
