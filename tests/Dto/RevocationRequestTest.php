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



use Authlete\Dto\RevocationRequest;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class RevocationRequestTest extends TestCase
{
    private const PARAMETERS    = '_parameters_';
    private const CLIENT_ID     = '_client_id_';
    private const CLIENT_SECRET = '_client_secret_';


    public function testParametersValidValue()
    {
        $obj = new RevocationRequest();
        $obj->setParameters(self::PARAMETERS);

        $this->assertEquals(self::PARAMETERS, $obj->getParameters());
    }


    public function testParametersValidNull()
    {
        $obj = new RevocationRequest();
        $obj->setParameters(null);

        $this->assertNull($obj->getParameters());
    }


    public function testParametersInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new RevocationRequest();

        $invalid = array();
        $obj->setParameters($invalid);
    }


    public function testClientIdValidValue()
    {
        $obj = new RevocationRequest();
        $obj->setClientId(self::CLIENT_ID);

        $this->assertEquals(self::CLIENT_ID, $obj->getClientId());
    }


    public function testClientIdValidNull()
    {
        $obj = new RevocationRequest();
        $obj->setClientId(null);

        $this->assertNull($obj->getClientId());
    }


    public function testClientIdInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new RevocationRequest();

        $invalid = array();
        $obj->setClientId($invalid);
    }


    public function testClientSecretValidValue()
    {
        $obj = new RevocationRequest();
        $obj->setClientSecret(self::CLIENT_SECRET);

        $this->assertEquals(self::CLIENT_SECRET, $obj->getClientSecret());
    }


    public function testClientSecretValidNull()
    {
        $obj = new RevocationRequest();
        $obj->setClientSecret(null);

        $this->assertNull($obj->getClientSecret());
    }


    public function testClientSecretInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new RevocationRequest();

        $invalid = array();
        $obj->setClientSecret($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = RevocationRequest::fromJson($json);

        $this->assertInstanceof(RevocationRequest::class, $obj);
    }


    public function testFromJsonTicketValidValue()
    {
        $json = '{"parameters":"' . self::PARAMETERS . '"}';
        $obj  = RevocationRequest::fromJson($json);

        $this->assertEquals(self::PARAMETERS, $obj->getParameters());
    }


    public function testFromJsonParametersValidNull()
    {
        $json = '{"parameters":null}';
        $obj  = RevocationRequest::fromJson($json);

        $this->assertNull($obj->getParameters());
    }


    public function testFromJsonParametersInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":true}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonParametersInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":123}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonParametersInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":["a","b"]}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonParametersInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":{"a":"b"}}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientIdValidValue()
    {
        $json = '{"clientId":"' . self::CLIENT_ID . '"}';
        $obj  = RevocationRequest::fromJson($json);

        $this->assertEquals(self::CLIENT_ID, $obj->getClientId());
    }


    public function testFromJsonClientIdValidNull()
    {
        $json = '{"clientId":null}';
        $obj  = RevocationRequest::fromJson($json);

        $this->assertNull($obj->getClientId());
    }


    public function testFromJsonClientIdInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientId":true}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientIdInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientId":123}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientIdInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientId":["a","b"]}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientIdInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientId":{"a":"b"}}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientSecretValidValue()
    {
        $json = '{"clientSecret":"' . self::CLIENT_SECRET . '"}';
        $obj  = RevocationRequest::fromJson($json);

        $this->assertEquals(self::CLIENT_SECRET, $obj->getClientSecret());
    }


    public function testFromJsonClientSecretValidNull()
    {
        $json = '{"clientSecret":null}';
        $obj  = RevocationRequest::fromJson($json);

        $this->assertNull($obj->getClientSecret());
    }


    public function testFromJsonClientSecretInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":true}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientSecretInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":123}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientSecretInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":["a","b"]}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testFromJsonClientSecretInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":{"a":"b"}}';
        $obj  = RevocationRequest::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new RevocationRequest();
        $obj->setParameters(self::PARAMETERS);
        $obj->setClientId(self::CLIENT_ID);
        $obj->setClientSecret(self::CLIENT_SECRET);

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // parameters
        $this->assertArrayHasKey('parameters', $array);
        $this->assertEquals(self::PARAMETERS, $array['parameters']);

        // clientId
        $this->assertArrayHasKey('clientId', $array);
        $this->assertEquals(self::CLIENT_ID, $array['clientId']);

        // clientSecret
        $this->assertArrayHasKey('clientSecret', $array);
        $this->assertEquals(self::CLIENT_SECRET, $array['clientSecret']);
    }
}