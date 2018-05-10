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
use Authlete\Dto\RevocationRequest;


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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testParametersInvalidValue()
    {
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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientIdInvalidValue()
    {
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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientSecretInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonParametersInvalidBool()
    {
        $json = '{"parameters":true}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonParametersInvalidNumber()
    {
        $json = '{"parameters":123}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonParametersInvalidArray()
    {
        $json = '{"parameters":["a","b"]}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonParametersInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientIdInvalidBool()
    {
        $json = '{"clientId":true}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientIdInvalidNumber()
    {
        $json = '{"clientId":123}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientIdInvalidArray()
    {
        $json = '{"clientId":["a","b"]}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientIdInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientSecretInvalidBool()
    {
        $json = '{"clientSecret":true}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientSecretInvalidNumber()
    {
        $json = '{"clientSecret":123}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientSecretInvalidArray()
    {
        $json = '{"clientSecret":["a","b"]}';
        $obj  = RevocationRequest::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientSecretInvalidObject()
    {
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
?>
