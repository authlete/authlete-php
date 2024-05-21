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


namespace Tests\Api;



use Authlete\Api\AuthleteApiException;
use Authlete\Api\AuthleteApiImpl;
use Authlete\Conf\AuthleteEnvConfiguration;
use PHPUnit\Framework\TestCase;


class AuthleteApiImplTest extends TestCase
{
    private static AuthleteEnvConfiguration $configuration;
    private static AuthleteApiImpl $api;


    public static function setUpBeforeClass(): void
    {
        // Create an instance which implements the AuthleteConfiguration
        // interface which holds parameters to access Authlete APIs.
        //
        // AuthleteEnvConfiguration reads the parameters from the
        // following environment variables.
        //
        //   - AUTHLETE_BASE_URL
        //   - AUTHLETE_SERVICEOWNER_APIKEY
        //   - AUTHLETE_SERVICEOWNER_APISECRET
        //   - AUTHLETE_SERVICE_APIKEY
        //   - AUTHLETE_SERVICE_APISECRET
        //
        self::$configuration = new AuthleteEnvConfiguration();

        try
        {
            // Create an instance which implements the AuthleteApi interface.
            self::$api = new AuthleteApiImpl(self::$configuration);
        }
        catch (\Exception $e)
        {
        }
    }


    public function setUp(): void
    {
        $this->skipIfEmpty(self::$configuration->getBaseUrl(),          'AUTHLETE_BASE_URL') ||
        $this->skipIfEmpty(self::$configuration->getServiceApiKey(),    'AUTHLETE_SERVICE_APIKEY') ||
        $this->skipIfEmpty(self::$configuration->getServiceApiSecret(), 'AUTHLETE_SERVICE_APISECRET') ||
        $this->skipIfEmpty(self::$configuration->getApiVersion(),       'AUTHLETE_API_VERSION')
        ;

        $apiVersion = self::$configuration->getApiVersion();
        // Skip all tests if the version is 3.0.0
        if (self::$configuration->getApiVersion() === '3.0.0') {
            $this->markTestSkipped("Skipping all tests for version $apiVersion");
        }
        ;
    }


    private function skipIfEmpty($value, $envname): bool
    {
        if (empty($value))
        {
            $this->markTestSkipped("The environment variable, {$envname}, is not set.");
        }

        return false;
    }


    /**
     * @throws AuthleteApiException
     */
    public function testConfiguration()
    {
        $json = self::$api->getServiceConfiguration();

        $this->assertNotNull($json);

        // Decode the response as JSON.
        $array = json_decode($json, true);
        $this->assertNotNull($array);

        // An expected property in the JSON.
        $this->assertArrayHasKey('issuer', $array);
    }
}

