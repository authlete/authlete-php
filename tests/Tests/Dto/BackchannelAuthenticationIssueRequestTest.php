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
use Authlete\Dto\BackchannelAuthenticationIssueRequest;


class BackchannelAuthenticationIssueRequestTest extends TestCase
{
    private const TICKET = '_ticket_';


    public function buildObj()
    {
        $obj = new BackchannelAuthenticationIssueRequest();
        $obj->setTicket(self::TICKET)
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
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // ticket
        $this->assertEquals(self::TICKET, $obj->getTicket());
    }
}
?>
