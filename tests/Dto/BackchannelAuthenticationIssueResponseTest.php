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



use Authlete\Dto\BackchannelAuthenticationIssueAction;
use Authlete\Dto\BackchannelAuthenticationIssueResponse;
use PHPUnit\Framework\TestCase;


class BackchannelAuthenticationIssueResponseTest extends TestCase
{
    private const RESPONSE_CONTENT = '_response_content_';
    private const AUTH_REQ_ID      = '_auth_req_id_';
    private const EXPIRES_IN       = 123;
    private const INTERVAL         = 456;


    public function buildObj()
    {
        $obj = new BackchannelAuthenticationIssueResponse();
        $obj->setAction(BackchannelAuthenticationIssueAction::OK)
            ->setResponseContent(self::RESPONSE_CONTENT)
            ->setAuthReqId(self::AUTH_REQ_ID)
            ->setExpiresIn(self::EXPIRES_IN)
            ->setInterval(self::INTERVAL)
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
        $this->assertEquals('OK', $array['action']);

        // responseContent
        $this->assertArrayHasKey('responseContent', $array);
        $this->assertEquals(self::RESPONSE_CONTENT, $array['responseContent']);

        // authReqId
        $this->assertArrayHasKey('authReqId', $array);
        $this->assertEquals(self::AUTH_REQ_ID, $array['authReqId']);

        // expiresIn
        $this->assertArrayHasKey('expiresIn', $array);
        $this->assertEquals(self::EXPIRES_IN, $array['expiresIn']);

        // interval
        $this->assertArrayHasKey('interval', $array);
        $this->assertEquals(self::INTERVAL, $array['interval']);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // action
        $this->assertEquals(BackchannelAuthenticationIssueAction::OK, $obj->getAction());

        // responseContent
        $this->assertEquals(self::RESPONSE_CONTENT, $obj->getResponseContent());

        // authReqId
        $this->assertEquals(self::AUTH_REQ_ID, $obj->getAuthReqId());

        // expiresIn
        $this->assertEquals(self::EXPIRES_IN, $obj->getExpiresIn());

        // interval
        $this->assertEquals(self::INTERVAL, $obj->getInterval());
    }
}
