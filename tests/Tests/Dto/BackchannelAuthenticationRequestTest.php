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
use Authlete\Dto\BackchannelAuthenticationRequest;


class BackchannelAuthenticationRequestTest extends TestCase
{
    private const PARAMETERS         = '_parameters_';
    private const CLIENT_ID          = '_client_id_';
    private const CLIENT_SECRET      = '_client_secret_';
    private const CLIENT_CERTIFICATE = '_client_certificate_';


    public function buildObj()
    {
        $obj = new BackchannelAuthenticationRequest();
        $obj->setParameters(self::PARAMETERS)
            ->setClientId(self::CLIENT_ID)
            ->setClientSecret(self::CLIENT_SECRET)
            ->setClientCertificate(self::CLIENT_CERTIFICATE)
            ->setClientCertificatePath(
                array(
                    "certificate-0",
                    "certificate-1"
                )
            )
        ;

        return $obj;
    }


    public function testToJson()
    {
        $obj   = $this->buildObj();
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

        // clientCertificate
        $this->assertArrayHasKey('clientCertificate', $array);
        $this->assertEquals(self::CLIENT_CERTIFICATE, $array['clientCertificate']);

        // clientCertificatePath
        $this->assertArrayHasKey('clientCertificatePath', $array);
        $certificates = $array['clientCertificatePath'];

        $this->assertTrue(is_array($certificates));
        $this->assertCount(2, $certificates);
        $this->assertEquals('certificate-0', $certificates[0]);
        $this->assertEquals('certificate-1', $certificates[1]);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // parameters
        $this->assertEquals(self::PARAMETERS, $obj->getParameters());

        // clientId
        $this->assertEquals(self::CLIENT_ID, $obj->getClientId());

        // clientSecret
        $this->assertEquals(self::CLIENT_SECRET, $obj->getClientSecret());

        // clientCertificate
        $this->assertEquals(self::CLIENT_CERTIFICATE, $obj->getClientCertificate());

        // clientCertificatePath
        $certificates = $obj->getClientCertificatePath();

        $this->assertTrue(is_array($certificates));
        $this->assertCount(2, $certificates);
        $this->assertEquals('certificate-0', $certificates[0]);
        $this->assertEquals('certificate-1', $certificates[1]);
    }
}
?>
