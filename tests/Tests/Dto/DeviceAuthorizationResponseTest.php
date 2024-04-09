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
use Authlete\Dto\DeviceAuthorizationAction;
use Authlete\Dto\DeviceAuthorizationResponse;
use Authlete\Dto\Scope;


class DeviceAuthorizationResponseTest extends TestCase
{
    private const RESPONSE_CONTENT          = '_response_content_';
    private const CLIENT_ID                 = 123;
    private const CLIENT_ID_ALIAS           = '_client_id_alias_';
    private const CLIENT_NAME               = '_client_name_';
    private const DEVICE_CODE               = '_device_code_';
    private const USER_CODE                 = '_user_code_';
    private const VERIFICATION_URI          = '_verification_uri_';
    private const VERIFICATION_URI_COMPLETE = '_verification_uri_complete_';
    private const EXPIRES_IN                = 456;
    private const INTERVAL                  = 789;


    public function buildObj(): DeviceAuthorizationResponse
    {
        $obj = new DeviceAuthorizationResponse();
        $obj->setAction(DeviceAuthorizationAction::$OK)
            ->setResponseContent(self::RESPONSE_CONTENT)
            ->setClientId(self::CLIENT_ID)
            ->setClientIdAlias(self::CLIENT_ID_ALIAS)
            ->setClientIdAliasUsed(true)
            ->setClientName(self::CLIENT_NAME)
            ->setScopes(
                array(
                    (new Scope())->setName('scope-0'),
                    (new Scope())->setName('scope-1')
                )
            )
            ->setClaimNames(
                array(
                    "claim-0",
                    "claim-1"
                )
            )
            ->setAcrs(
                array(
                    "acr-0",
                    "acr-1"
                )
            )
            ->setDeviceCode(self::DEVICE_CODE)
            ->setUserCode(self::USER_CODE)
            ->setVerificationUri(self::VERIFICATION_URI)
            ->setVerificationUriComplete(self::VERIFICATION_URI_COMPLETE)
            ->setExpiresIn(self::EXPIRES_IN)
            ->setInterval(self::INTERVAL)
            ->setResources(
                array(
                    "resource-0",
                    "resource-1"
                )
            )
            ->setWarnings(
                array(
                    "warning-0",
                    "warning-1"
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

        // action
        $this->assertArrayHasKey('action', $array);
        $this->assertEquals('OK', $array['action']);

        // responseContent
        $this->assertArrayHasKey('responseContent', $array);
        $this->assertEquals(self::RESPONSE_CONTENT, $array['responseContent']);

        // clientId
        $this->assertArrayHasKey('clientId', $array);
        $this->assertEquals(self::CLIENT_ID, $array['clientId']);

        // clientIdAlias
        $this->assertArrayHasKey('clientIdAlias', $array);
        $this->assertEquals(self::CLIENT_ID_ALIAS, $array['clientIdAlias']);

        // clientIdAliasUsed
        $this->assertArrayHasKey('clientIdAliasUsed', $array);
        $this->assertTrue($array['clientIdAliasUsed']);

        // clientName
        $this->assertArrayHasKey('clientName', $array);
        $this->assertEquals(self::CLIENT_NAME, $array['clientName']);

        // scopes
        $this->assertArrayHasKey('scopes', $array);
        $scopes = $array['scopes'];

        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);

        $scope0 = $scopes[0];
        $this->assertTrue(is_array($scope0));
        $this->assertArrayHasKey('name', $scope0);
        $this->assertEquals('scope-0', $scope0['name']);

        $scope1 = $scopes[1];
        $this->assertTrue(is_array($scope1));
        $this->assertArrayHasKey('name', $scope1);
        $this->assertEquals('scope-1', $scope1['name']);

        // claimNames
        $this->assertArrayHasKey('claimNames', $array);
        $claimNames = $array['claimNames'];

        $this->assertTrue(is_array($claimNames));
        $this->assertCount(2, $claimNames);
        $this->assertEquals('claim-0', $claimNames[0]);
        $this->assertEquals('claim-1', $claimNames[1]);

        // acrs
        $this->assertArrayHasKey('acrs', $array);
        $acrs = $array['acrs'];

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr-0', $acrs[0]);
        $this->assertEquals('acr-1', $acrs[1]);

        // deviceCode
        $this->assertArrayHasKey('deviceCode', $array);
        $this->assertEquals(self::DEVICE_CODE, $array['deviceCode']);

        // userCode
        $this->assertArrayHasKey('userCode', $array);
        $this->assertEquals(self::USER_CODE, $array['userCode']);

        // verificationUri
        $this->assertArrayHasKey('verificationUri', $array);
        $this->assertEquals(self::VERIFICATION_URI, $array['verificationUri']);

        // verificationUriComplete
        $this->assertArrayHasKey('verificationUriComplete', $array);
        $this->assertEquals(self::VERIFICATION_URI_COMPLETE, $array['verificationUriComplete']);

        // expiresIn
        $this->assertArrayHasKey('expiresIn', $array);
        $this->assertEquals(self::EXPIRES_IN, $array['expiresIn']);

        // interval
        $this->assertArrayHasKey('interval', $array);
        $this->assertEquals(self::INTERVAL, $array['interval']);

        // resources
        $this->assertArrayHasKey('resources', $array);
        $resources = $array['resources'];

        $this->assertTrue(is_array($resources));
        $this->assertCount(2, $resources);
        $this->assertEquals('resource-0', $resources[0]);
        $this->assertEquals('resource-1', $resources[1]);

        // warnings
        $this->assertArrayHasKey('warnings', $array);
        $warnings = $array['warnings'];

        $this->assertTrue(is_array($warnings));
        $this->assertCount(2, $warnings);
        $this->assertEquals('warning-0', $warnings[0]);
        $this->assertEquals('warning-1', $warnings[1]);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // action
        $this->assertEquals(DeviceAuthorizationAction::OK, $obj->getAction());

        // responseContent
        $this->assertEquals(self::RESPONSE_CONTENT, $obj->getResponseContent());

        // clientId
        $this->assertEquals(self::CLIENT_ID, $obj->getClientId());

        // clientIdAlias
        $this->assertEquals(self::CLIENT_ID_ALIAS, $obj->getClientIdAlias());

        // clientIdAliasUsed
        $this->assertTrue($obj->isClientIdAliasUsed());

        // clientName
        $this->assertEquals(self::CLIENT_NAME, $obj->getClientName());

        // scopes
        $scopes = $obj->getScopes();

        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);

        $scope0 = $scopes[0];
        $this->assertEquals('scope-0', $scope0->getName());

        $scope1 = $scopes[1];
        $this->assertEquals('scope-1', $scope1->getName());

        // claimNames
        $claimNames = $obj->getClaimNames();

        $this->assertTrue(is_array($claimNames));
        $this->assertCount(2, $claimNames);
        $this->assertEquals('claim-0', $claimNames[0]);
        $this->assertEquals('claim-1', $claimNames[1]);

        // acrs
        $acrs = $obj->getAcrs();

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr-0', $acrs[0]);
        $this->assertEquals('acr-1', $acrs[1]);

        // deviceCode
        $this->assertEquals(self::DEVICE_CODE, $obj->getDeviceCode());

        // userCode
        $this->assertEquals(self::USER_CODE, $obj->getUserCode());

        // verificationUri
        $this->assertEquals(self::VERIFICATION_URI, $obj->getVerificationUri());

        // verificationUriComplete
        $this->assertEquals(self::VERIFICATION_URI_COMPLETE, $obj->getVerificationUriComplete());

        // expiresIn
        $this->assertEquals(self::EXPIRES_IN, $obj->getExpiresIn());

        // interval
        $this->assertEquals(self::INTERVAL, $obj->getInterval());

        // resources
        $resources = $obj->getResources();

        $this->assertTrue(is_array($resources));
        $this->assertCount(2, $resources);
        $this->assertEquals('resource-0', $resources[0]);
        $this->assertEquals('resource-1', $resources[1]);

        // warnings
        $warnings = $obj->getWarnings();

        $this->assertTrue(is_array($warnings));
        $this->assertCount(2, $warnings);
        $this->assertEquals('warning-0', $warnings[0]);
        $this->assertEquals('warning-1', $warnings[1]);
    }
}
