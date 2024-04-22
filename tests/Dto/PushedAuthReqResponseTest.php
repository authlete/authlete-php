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




use Authlete\Dto\PushedAuthReqAction;
use Authlete\Dto\PushedAuthReqResponse;
use PHPUnit\Framework\TestCase;


class PushedAuthReqResponseTest extends TestCase
{
    private const RESPONSE_CONTENT = '_response_content_';
    private const REQUEST_URI      = '_request_uri_';


    public function buildObj(): PushedAuthReqResponse
    {
        $obj = new PushedAuthReqResponse();
        $obj->setAction(PushedAuthReqAction::CREATED)
            ->setResponseContent(self::RESPONSE_CONTENT)
            ->setRequestUri(self::REQUEST_URI)
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
        $this->assertEquals('CREATED', $array['action']);

        // responseContent
        $this->assertArrayHasKey('responseContent', $array);
        $this->assertEquals(self::RESPONSE_CONTENT, $array['responseContent']);

        // requestUri
        $this->assertArrayHasKey('requestUri', $array);
        $this->assertEquals(self::REQUEST_URI, $array['requestUri']);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // action
        $this->assertEquals(PushedAuthReqAction::CREATED, $obj->getAction());

        // responseContent
        $this->assertEquals(self::RESPONSE_CONTENT, $obj->getResponseContent());

        // requestUri
        $this->assertEquals(self::REQUEST_URI, $obj->getRequestUri());
    }
}