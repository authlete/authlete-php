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
use Authlete\Dto\AuthorizationIssueReason;
use Authlete\Dto\AuthorizationIssueRequest;
use Authlete\Dto\Property;


class AuthorizationIssueRequestTest extends TestCase
{
    private const TICKET        = '_ticket_';
    private const SUBJECT       = '_subject_';
    private const SUB           = '_sub_';
    private const AUTH_TIME_INT = 10000;
    private const AUTH_TIME_STR = '20000';
    private const ACR           = '_acr_';
    private const CLAIMS        = '_claims_';


    public function testTicketValidValue()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setTicket(self::TICKET);

        $this->assertEquals(self::TICKET, $obj->getTicket());
    }


    public function testTicketValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setTicket(null);

        $this->assertNull($obj->getTicket());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testTicketInvalidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array();
        $obj->setTicket($invalid);
    }


    public function testSubjectValidValue()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setSubject(self::SUBJECT);

        $this->assertEquals(self::SUBJECT, $obj->getSubject());
    }


    public function testSubjectValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setSubject(null);

        $this->assertNull($obj->getSubject());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testSubjectInvalidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array();
        $obj->setSubject($invalid);
    }


    public function testSubValidValue()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setSub(self::SUB);

        $this->assertEquals(self::SUB, $obj->getSub());
    }


    public function testSubValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setSub(null);

        $this->assertNull($obj->getSub());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testSubInvalidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array();
        $obj->setSub($invalid);
    }


    public function testAuthTimeValidInt()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setAuthTime(self::AUTH_TIME_INT);

        $this->assertSame(self::AUTH_TIME_INT, $obj->getAuthTime());
    }


    public function testAuthTimeValidStr()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setAuthTime(self::AUTH_TIME_STR);

        $this->assertSame(self::AUTH_TIME_STR, $obj->getAuthTime());
    }


    public function testAuthTimeValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setAuthTime(null);

        $this->assertNull($obj->getAuthTime());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testAuthTimeInvalidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array();
        $obj->setAuthTime($invalid);
    }


    public function testAcrValidValue()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setAcr(self::ACR);

        $this->assertEquals(self::ACR, $obj->getAcr());
    }


    public function testAcrValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setAcr(null);

        $this->assertNull($obj->getAcr());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testAcrInvalidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array();
        $obj->setAcr($invalid);
    }


    public function testClaimsValidValue()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setClaims(self::CLAIMS);

        $this->assertEquals(self::CLAIMS, $obj->getClaims());
    }


    public function testClaimsValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setClaims(null);

        $this->assertNull($obj->getClaims());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClaimsInvalidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array();
        $obj->setClaims($invalid);
    }


    public function testPropertiesValidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $array = array(
            new Property('key0', 'value0', true),
            new Property('key1', 'value1', false)
        );
        $obj->setProperties($array);

        $properties = $obj->getProperties();

        $this->assertTrue(is_array($properties));
        $this->assertCount(2, $properties);
        $this->assertInstanceOf(Property::class, $properties[0]);
        $this->assertInstanceOf(Property::class, $properties[1]);
    }


    public function testPropertiesValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setProperties(null);

        $this->assertNull($obj->getProperties());
    }


    /**
     * @expectedException Error
     */
    public function testPropertiesInvalidType()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = '__INVALID__';
        $obj->setProperties($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testPropertiesInvalidElement()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array('__INVALID__');
        $obj->setProperties($invalid);
    }


    public function testScopesValidValue()
    {
        $obj = new AuthorizationIssueRequest();

        $array = array('scope0', 'scope1');
        $obj->setScopes($array);

        $scopes = $obj->getScopes();

        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);
        $this->assertTrue(is_string($scopes[0]));
        $this->assertTrue(is_string($scopes[1]));
    }


    public function testScopesValidNull()
    {
        $obj = new AuthorizationIssueRequest();
        $obj->setScopes(null);

        $this->assertNull($obj->getScopes());
    }


    /**
     * @expectedException Error
     */
    public function testScopesInvalidType()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = '__INVALID__';
        $obj->setScopes($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testScopesInvalidElement()
    {
        $obj = new AuthorizationIssueRequest();

        $invalid = array(array(), array());
        $obj->setScopes($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertInstanceof(AuthorizationIssueRequest::class, $obj);
    }


    public function testFromJsonTicketValidValue()
    {
        $json = '{"ticket":"' . self::TICKET . '"}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertEquals(self::TICKET, $obj->getTicket());
    }


    public function testFromJsonTicketValidNull()
    {
        $json = '{"ticket":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getTicket());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidBool()
    {
        $json = '{"ticket":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidNumber()
    {
        $json = '{"ticket":123}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidArray()
    {
        $json = '{"ticket":["a","b"]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidObject()
    {
        $json = '{"ticket":{"a":"b"}}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testFromJsonSubjectValidValue()
    {
        $json = '{"subject":"' . self::SUBJECT . '"}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertEquals(self::SUBJECT, $obj->getSubject());
    }


    public function testFromJsonSubjectValidNull()
    {
        $json = '{"subject":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getSubject());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidBool()
    {
        $json = '{"subject":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidNumber()
    {
        $json = '{"subject":123}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidArray()
    {
        $json = '{"subject":["a","b"]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidObject()
    {
        $json = '{"subject":{"a":"b"}}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testFromJsonSubValidValue()
    {
        $json = '{"sub":"' . self::SUB . '"}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertEquals(self::SUB, $obj->getSub());
    }


    public function testFromJsonSubValidNull()
    {
        $json = '{"sub":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getSub());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubInvalidBool()
    {
        $json = '{"sub":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubInvalidNumber()
    {
        $json = '{"sub":123}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubInvalidArray()
    {
        $json = '{"sub":["a","b"]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubInvalidObject()
    {
        $json = '{"sub":{"a":"b"}}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testFromJsonAuthTimeValidInteger()
    {
        $json = '{"authTime":' . self::AUTH_TIME_INT . '}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertEquals(self::AUTH_TIME_INT, $obj->getAuthTime());
    }


    public function testFromJsonAuthTimeValidString()
    {
        $json = '{"authTime":"' . self::AUTH_TIME_STR . '"}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertEquals(self::AUTH_TIME_STR, $obj->getAuthTime());
    }


    public function testFromJsonAuthTimeValidNull()
    {
        $json = '{"authTime":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getAuthTime());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAuthTimeInvalidBool()
    {
        $json = '{"authTime":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAuthTimeInvalidArray()
    {
        $json = '{"authTime":["a","b"]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAuthTimeInvalidObject()
    {
        $json = '{"authTime":{"a":"b"}}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testFromJsonAcrValidValue()
    {
        $json = '{"acr":"' . self::ACR . '"}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertEquals(self::ACR, $obj->getAcr());
    }


    public function testFromJsonAcrValidNull()
    {
        $json = '{"acr":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getAcr());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAcrInvalidBool()
    {
        $json = '{"acr":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAcrInvalidNumber()
    {
        $json = '{"acr":123}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAcrInvalidArray()
    {
        $json = '{"acr":["a","b"]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAcrInvalidObject()
    {
        $json = '{"acr":{"a":"b"}}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testFromJsonClaimsValidValue()
    {
        $json = '{"claims":"' . self::CLAIMS . '"}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertEquals(self::CLAIMS, $obj->getClaims());
    }


    public function testFromJsonClaimsValidNull()
    {
        $json = '{"claims":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getClaims());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClaimsInvalidBool()
    {
        $json = '{"claims":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClaimsInvalidNumber()
    {
        $json = '{"claims":123}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClaimsInvalidArray()
    {
        $json = '{"claims":["a","b"]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClaimsInvalidObject()
    {
        $json = '{"claims":{"a":"b"}}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testFromJsonPropertiesValidValue()
    {
        $json = '{"properties":[{"key":"key0","value":"value0","hidden":true},'
              . '{"key":"key1","value":"value1","hidden":false}]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $properties = $obj->getProperties();
        $this->assertTrue(is_array($properties));
        $this->assertCount(2, $properties);

        $property0 = $properties[0];
        $this->assertInstanceOf(Property::class, $property0);
        $this->assertEquals('key0',   $property0->getKey());
        $this->assertEquals('value0', $property0->getValue());
        $this->assertEquals(true,     $property0->isHidden());

        $property1 = $properties[1];
        $this->assertInstanceOf(Property::class, $property1);
        $this->assertEquals('key1',   $property1->getKey());
        $this->assertEquals('value1', $property1->getValue());
        $this->assertEquals(false,    $property1->isHidden());
    }


    public function testFromJsonPropertiesValidNull()
    {
        $json = '{"properties":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getProperties());
    }


    /** @expectedException Error */
    public function testFromJsonPropertiesInvalidBool()
    {
        $json = '{"properties":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPropertiesInvalidNumber()
    {
        $json = '{"properties":123}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPropertiesInvalidArray()
    {
        $json = '{"properties":["a","b"]}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPropertiesInvalidObject()
    {
        $json = '{"properties":{"a":"b"}}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testFromJsonScopesValidValue()
    {
        $json = '{"scopes":["scope0","scope1"]}';

        $obj  = AuthorizationIssueRequest::fromJson($json);

        $scopes = $obj->getScopes();
        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);
        $this->assertEquals('scope0', $scopes[0]);
        $this->assertEquals('scope1', $scopes[1]);
    }


    public function testFromJsonScopesValidNull()
    {
        $json = '{"scopes":null}';
        $obj  = AuthorizationIssueRequest::fromJson($json);

        $this->assertNull($obj->getScopes());
    }


    /** @expectedException Error */
    public function testFromJsonScopesInvalidBool()
    {
        $json = '{"scopes":true}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonScopesInvalidNumber()
    {
        $json = '{"scopes":123}';
        $obj  = AuthorizationIssueRequest::fromJson($json);
    }


    public function testToJson()
    {
        $properties = array(
            new Property('key0', 'value0', true),
            new Property('key1', 'value1', false)
        );

        $scopes = array('scope0', 'scope1');

        $obj = new AuthorizationIssueRequest();
        $obj->setTicket(self::TICKET)
            ->setSubject(self::SUBJECT)
            ->setSub(self::SUB)
            ->setAuthTime(self::AUTH_TIME_INT)
            ->setAcr(self::ACR)
            ->setClaims(self::CLAIMS)
            ->setProperties($properties)
            ->setScopes($scopes)
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // ticket
        $this->assertArrayHasKey('ticket', $array);
        $this->assertEquals(self::TICKET, $array['ticket']);

        // subject
        $this->assertArrayHasKey('subject', $array);
        $this->assertEquals(self::SUBJECT, $array['subject']);

        // sub
        $this->assertArrayHasKey('sub', $array);
        $this->assertEquals(self::SUB, $array['sub']);

        // authTime
        $this->assertArrayHasKey('authTime', $array);
        $this->assertEquals(self::AUTH_TIME_INT, $array['authTime']);

        // acr
        $this->assertArrayHasKey('acr', $array);
        $this->assertEquals(self::ACR, $array['acr']);

        // claims
        $this->assertArrayHasKey('claims', $array);
        $this->assertEquals(self::CLAIMS, $array['claims']);

        // properties
        $this->assertArrayHasKey('properties', $array);
        $subArray = $array['properties'];
        $this->assertTrue(is_array($subArray));
        $this->assertCount(2, $subArray);

        // properties: the first entry
        $property0 = $subArray[0];
        $this->assertArrayHasKey('key',    $property0);
        $this->assertArrayHasKey('value',  $property0);
        $this->assertArrayHasKey('hidden', $property0);
        $this->assertEquals('key0',   $property0['key']);
        $this->assertEquals('value0', $property0['value']);
        $this->assertEquals(true,     $property0['hidden']);

        // properties: the second entry
        $property1 = $subArray[1];
        $this->assertArrayHasKey('key',    $property1);
        $this->assertArrayHasKey('value',  $property1);
        $this->assertArrayHasKey('hidden', $property1);
        $this->assertEquals('key1',   $property1['key']);
        $this->assertEquals('value1', $property1['value']);
        $this->assertEquals(false,    $property1['hidden']);

        // scopes
        $this->assertArrayHasKey('scopes', $array);
        $subArray = $array['scopes'];
        $this->assertTrue(is_array($subArray));
        $this->assertCount(2, $subArray);

        // scopes: the first entry
        $this->assertEquals('scope0', $subArray[0]);

        // scopes: the second entry
        $this->assertEquals('scope1', $subArray[1]);
    }
}
?>
