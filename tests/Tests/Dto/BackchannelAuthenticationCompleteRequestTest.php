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
use Authlete\Dto\BackchannelAuthenticationCompleteRequest;
use Authlete\Dto\BackchannelAuthenticationCompleteResult;
use Authlete\Dto\Property;


class BackchannelAuthenticationCompleteRequestTest extends TestCase
{
    private const TICKET            = '_ticket_';
    private const SUBJECT           = '_subject_';
    private const SUB               = '_sub_';
    private const AUTH_TIME         = 123;
    private const ACR               = '_acr_';
    private const CLAIMS            = '_claims_';
    private const ERROR_DESCRIPTION = '_error_description_';
    private const ERROR_URI         = '_error_uri_';


    public function buildObj()
    {
        $obj = new BackchannelAuthenticationCompleteRequest();
        $obj->setTicket(self::TICKET)
            ->setResult(BackchannelAuthenticationCompleteResult::$AUTHORIZED)
            ->setSubject(self::SUBJECT)
            ->setSub(self::SUB)
            ->setAuthTime(self::AUTH_TIME)
            ->setAcr(self::ACR)
            ->setClaims(self::CLAIMS)
            ->setProperties(
                array(
                    (new Property('key-0', 'value-0', true)),
                    (new Property('key-1', 'value-1', false))
                )
            )
            ->setScopes(
                array(
                    "scope-0",
                    "scope-1"
                )
            )
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

        // result
        $this->assertArrayHasKey('result', $array);
        $this->assertEquals('AUTHORIZED', $array['result']);

        // subject
        $this->assertArrayHasKey('subject', $array);
        $this->assertEquals(self::SUBJECT, $array['subject']);

        // sub
        $this->assertArrayHasKey('sub', $array);
        $this->assertEquals(self::SUB, $array['sub']);

        // authTime
        $this->assertArrayHasKey('authTime', $array);
        $this->assertEquals(self::AUTH_TIME, $array['authTime']);

        // acr
        $this->assertArrayHasKey('acr', $array);
        $this->assertEquals(self::ACR, $array['acr']);

        // claims
        $this->assertArrayHasKey('claims', $array);
        $this->assertEquals(self::CLAIMS, $array['claims']);

        // properties
        $this->assertArrayHasKey('properties', $array);
        $properties = $array['properties'];
        $this->assertTrue(is_array($properties));
        $this->assertCount(2, $properties);

        // properties: the first entry
        $property0 = $properties[0];
        $this->assertArrayHasKey('key',    $property0);
        $this->assertArrayHasKey('value',  $property0);
        $this->assertArrayHasKey('hidden', $property0);
        $this->assertEquals('key-0',   $property0['key']);
        $this->assertEquals('value-0', $property0['value']);
        $this->assertEquals(true,      $property0['hidden']);

        // properties: the second entry
        $property1 = $properties[1];
        $this->assertArrayHasKey('key',    $property1);
        $this->assertArrayHasKey('value',  $property1);
        $this->assertArrayHasKey('hidden', $property1);
        $this->assertEquals('key-1',   $property1['key']);
        $this->assertEquals('value-1', $property1['value']);
        $this->assertEquals(false,     $property1['hidden']);

        // scopes
        $this->assertArrayHasKey('scopes', $array);
        $scopes = $array['scopes'];
        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);

        // scopes: the first entry
        $this->assertEquals('scope-0', $scopes[0]);

        // scopes: the second entry
        $this->assertEquals('scope-1', $scopes[1]);

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

        // result
        $this->assertEquals(BackchannelAuthenticationCompleteResult::$AUTHORIZED, $obj->getResult());

        // subject
        $this->assertEquals(self::SUBJECT, $obj->getSubject());

        // sub
        $this->assertEquals(self::SUB, $obj->getSub());

        // authTime
        $this->assertEquals(self::AUTH_TIME, $obj->getAuthTime());

        // acr
        $this->assertEquals(self::ACR, $obj->getAcr());

        // claims
        $this->assertEquals(self::CLAIMS, $obj->getClaims());

        // properties
        $properties = $obj->getProperties();
        $this->assertTrue(is_array($properties));
        $this->assertCount(2, $properties);

        // properties: the first entry
        $property0 = $properties[0];
        $this->assertEquals('key-0',   $property0->getKey());
        $this->assertEquals('value-0', $property0->getValue());
        $this->assertEquals(true,      $property0->isHidden());

        // properties: the second entry
        $property1 = $properties[1];
        $this->assertEquals('key-1',   $property1->getKey());
        $this->assertEquals('value-1', $property1->getValue());
        $this->assertEquals(false,     $property1->isHidden());

        // scopes
        $scopes = $obj->getScopes();
        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);

        // scopes: the first entry
        $this->assertEquals('scope-0', $scopes[0]);

        // scopes: the second entry
        $this->assertEquals('scope-1', $scopes[1]);

        // errorDescription
        $this->assertEquals(self::ERROR_DESCRIPTION, $obj->getErrorDescription());

        // errorUri
        $this->assertEquals(self::ERROR_URI, $obj->getErrorUri());
    }
}
?>
