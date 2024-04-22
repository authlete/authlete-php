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



use Authlete\Dto\BackchannelAuthenticationFailReason;
use Authlete\Dto\BackchannelAuthenticationFailRequest;
use PHPUnit\Framework\TestCase;


class BackchannelAuthenticationFailRequestTest extends TestCase
{
    private const TICKET            = '_ticket_';
    private const ERROR_DESCRIPTION = '_error_description_';
    private const ERROR_URI         = '_error_uri_';


    public function buildObj(): BackchannelAuthenticationFailRequest
    {
        $obj = new BackchannelAuthenticationFailRequest();
        $obj->setTicket(self::TICKET)
            ->setReason(BackchannelAuthenticationFailReason::UNKNOWN_USER_ID)
            ->setErrorDescription(self::ERROR_DESCRIPTION)
            ->setErrorUri(self::ERROR_URI)
        ;

        return $obj;
    }


    public function testToJson()
    {
        $obj   = $this->buildObj();
        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // ticket
        $this->assertArrayHasKey('ticket', $array);
        $this->assertEquals(self::TICKET, $array['ticket']);

        // reason
        $this->assertArrayHasKey('reason', $array);
        $this->assertEquals('UNKNOWN_USER_ID', $array['reason']);

        // errorDescription
        $this->assertArrayHasKey('errorDescription', $array);
        $this->assertEquals(self::ERROR_DESCRIPTION, $array['errorDescription']);

        // errorUri
        $this->assertArrayHasKey('errorUri', $array);
        $this->assertEquals(self::ERROR_URI, $array['errorUri']);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // ticket
        $this->assertEquals(self::TICKET, $obj->getTicket());

        // reason
        $this->assertEquals(BackchannelAuthenticationFailReason::UNKNOWN_USER_ID, $obj->getReason());

        // errorDescription
        $this->assertEquals(self::ERROR_DESCRIPTION, $obj->getErrorDescription());

        // errorUri
        $this->assertEquals(self::ERROR_URI, $obj->getErrorUri());
    }
}
