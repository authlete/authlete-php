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


namespace Authlete\Tests\Dto;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Dto\AuthorizationFailReason;
use Authlete\Dto\AuthorizationFailRequest;


class AuthorizationFailRequestTest extends TestCase
{
    private const TICKET      = '_ticket_';
    private const DESCRIPTION = '_description_';


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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testTicketInvalidValue()
    {
        $obj = new AuthorizationFailRequest();

        $invalid = array();
        $obj->setTicket($invalid);
    }


    public function testReasonValidValue()
    {
        $obj = new AuthorizationFailRequest();

        $reason = AuthorizationFailReason::$UNKNOWN;
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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testDescriptionInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidBool()
    {
        $json = '{"ticket":true}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidNumber()
    {
        $json = '{"ticket":123}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidArray()
    {
        $json = '{"ticket":["a","b"]}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidObject()
    {
        $json = '{"ticket":{"a":"b"}}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testFromJsonReasonValidValue()
    {
        $json = '{"reason":"UNKNOWN"}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertSame(AuthorizationFailReason::$UNKNOWN, $obj->getReason());
    }


    public function testFromJsonReasonValidNull()
    {
        $json = '{"reason":null}';
        $obj  = AuthorizationFailRequest::fromJson($json);

        $this->assertNull($obj->getReason());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonReasonInvalidBool()
    {
        $json = '{"reason":true}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonReasonInvalidNumber()
    {
        $json = '{"reason":123}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonReasonInvalidArray()
    {
        $json = '{"reason":["a","b"]}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonReasonInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidBool()
    {
        $json = '{"description":true}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidNumber()
    {
        $json = '{"description":123}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidArray()
    {
        $json = '{"description":["a","b"]}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidObject()
    {
        $json = '{"description":{"a":"b"}}';
        $obj  = AuthorizationFailRequest::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new AuthorizationFailRequest();
        $obj->setTicket(self::TICKET)
            ->setReason(AuthorizationFailReason::$UNKNOWN)
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
?>
