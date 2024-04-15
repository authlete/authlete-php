<?php
//
// Copyright (C) 2018 Authlete, Inc.
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



use Authlete\Dto\AuthorizationFailReason;
use Authlete\Dto\AuthorizationFailRequest;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class AuthorizationFailRequestTest extends TestCase
{
    private const string TICKET      = '_ticket_';
    private const string DESCRIPTION = '_description_';


    public function testTicketValidValue()
    {
        $obj = new AuthorizationFailRequest();
        $obj->setTicket(self::TICKET);

        $this->assertEquals(self::TICKET, $obj->getTicket());
    }


    public function testTicketValidNull()
    {
        $obj = new AuthorizationFailRequest();
        $obj->setTicket(null);

        $this->assertNull($obj->getTicket());
    }


    public function testTicketInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new AuthorizationFailRequest();

        $invalid = array();
        $obj->setTicket($invalid);
    }


    public function testReasonValidValue()
    {
        $obj = new AuthorizationFailRequest();

        $reason = AuthorizationFailReason::UNKNOWN;
        $obj->setReason($reason);

        $this->assertSame($reason, $obj->getReason());
    }


    public function testReasonValidNull()
    {
        $obj = new AuthorizationFailRequest();
        $obj->setReason(null);

        $this->assertNull($obj->getReason());
    }


    public function testDescriptionValidValue()
    {
        $obj = new AuthorizationFailRequest();
        $obj->setDescription(self::DESCRIPTION);

        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());
    }


    public function testDescriptionValidNull()
    {
        $obj = new AuthorizationFailRequest();
        $obj->setDescription(null);

        $this->assertNull($obj->getDescription());
    }


    public function testDescriptionInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new AuthorizationFailRequest();

        $invalid = array();
        $obj->setDescription($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertInstanceof(AuthorizationFailRequest::class, $obj);
    }


    public function testFromJsonTicketValidValue()
    {
        $json = '{"ticket":"' . self::TICKET . '"}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertEquals(self::TICKET, $obj->getTicket());
    }


    public function testFromJsonTicketValidNull()
    {
        $json = '{"ticket":null}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertNull($obj->getTicket());
    }


    public function testFromJsonTicketInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"ticket":true}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonTicketInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"ticket":123}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonTicketInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"ticket":["a","b"]}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonTicketInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"ticket":{"a":"b"}}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonReasonValidValue()
    {
        $json = '{"reason":"UNKNOWN"}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertSame(AuthorizationFailReason::UNKNOWN, $obj->getReason());
    }


    public function testFromJsonReasonValidNull()
    {
        $json = '{"reason":null}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertNull($obj->getReason());
    }


    public function testFromJsonReasonInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"reason":true}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonReasonInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"reason":123}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonReasonInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"reason":["a","b"]}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonReasonInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"reason":{"a":"b"}}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonDescriptionValidValue()
    {
        $json = '{"description":"' . self::DESCRIPTION . '"}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());
    }


    public function testFromJsonDescriptionValidNull()
    {
        $json = '{"description":null}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertNull($obj->getDescription());
    }


    public function testFromJsonDescriptionInvalidBool()
    {
        $this->expectException(\InvalidArgumentException::class);
        $json = '{"description":true}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonDescriptionInvalidNumber()
    {
        $this->expectException(\InvalidArgumentException::class);
        $json = '{"description":123}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonDescriptionInvalidArray()
    {
        $this->expectException(\InvalidArgumentException::class);
        $json = '{"description":["a","b"]}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonDescriptionInvalidObject()
    {
        $this->expectException(\InvalidArgumentException::class);
        $json = '{"description":{"a":"b"}}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new AuthorizationFailRequest();
        $obj->setTicket(self::TICKET)
            ->setReason(AuthorizationFailReason::UNKNOWN)
            ->setDescription(self::DESCRIPTION)
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // ticket
        $this->assertArrayHasKey('ticket', $array);
        $this->assertEquals(self::TICKET, $array['ticket']);

        // reason
        $this->assertArrayHasKey('reason', $array);
        $this->assertEquals('UNKNOWN', $array['reason']);

        // description
        $this->assertArrayHasKey('description', $array);
        $this->assertEquals(self::DESCRIPTION, $array['description']);
    }
}
