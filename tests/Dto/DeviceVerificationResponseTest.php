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


namespace Tests\Dto;



use Authlete\Dto\DeviceVerificationAction;
use Authlete\Dto\DeviceVerificationResponse;
use Authlete\Dto\Scope;
use PHPUnit\Framework\TestCase;


class DeviceVerificationResponseTest extends TestCase
{
    private const CLIENT_ID       = 123;
    private const CLIENT_ID_ALIAS = '_client_id_alias_';
    private const CLIENT_NAME     = '_client_name_';
    private const EXPIRES_AT      = 456;


    public function buildObj(): DeviceVerificationResponse
    {
        $obj = new DeviceVerificationResponse();
        $obj->setAction(DeviceVerificationAction::VALID)
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
            ->setExpiresAt(self::EXPIRES_AT)
            ->setResources(
                array(
                    "resource-0",
                    "resource-1"
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
        $this->assertEquals('VALID', $array['action']);

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

        // expiresAt
        $this->assertArrayHasKey('expiresAt', $array);
        $this->assertEquals(self::EXPIRES_AT, $array['expiresAt']);

        // resources
        $this->assertArrayHasKey('resources', $array);
        $resources = $array['resources'];

        $this->assertTrue(is_array($resources));
        $this->assertCount(2, $resources);
        $this->assertEquals('resource-0', $resources[0]);
        $this->assertEquals('resource-1', $resources[1]);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // action
        $this->assertEquals(DeviceVerificationAction::VALID, $obj->getAction());

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

        // expiresAt
        $this->assertEquals(self::EXPIRES_AT, $obj->getExpiresAt());

        // resources
        $resources = $obj->getResources();

        $this->assertTrue(is_array($resources));
        $this->assertCount(2, $resources);
        $this->assertEquals('resource-0', $resources[0]);
        $this->assertEquals('resource-1', $resources[1]);
    }
}
