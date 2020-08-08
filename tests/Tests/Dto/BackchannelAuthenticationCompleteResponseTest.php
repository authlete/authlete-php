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
use Authlete\Dto\BackchannelAuthenticationCompleteAction;
use Authlete\Dto\BackchannelAuthenticationCompleteResponse;
use Authlete\Types\DeliveryMode;


class BackchannelAuthenticationCompleteResponseTest extends TestCase
{
    private const RESPONSE_CONTENT             = '_response_content_';
    private const CLIENT_ID                    = 1;
    private const CLIENT_ID_ALIAS              = '_client_id_alias_';
    private const CLIENT_NAME                  = '_client_name_';
    private const CLIENT_NOTIFICATION_ENDPOINT = '_client_notification_endpoint_';
    private const CLIENT_NOTIFICATION_TOKEN    = '_client_notification_token';
    private const AUTH_REQ_ID                  = '_auth_req_id_';
    private const ACCESS_TOKEN                 = '_access_token_';
    private const REFRESH_TOKEN                = '_refresh_token_';
    private const ID_TOKEN                     = '_id_token_';
    private const ACCESS_TOKEN_DURATION        = 2;
    private const REFRESH_TOKEN_DURATION       = 3;
    private const ID_TOKEN_DURATION            = 4;
    private const JWT_ACCESS_TOKEN             = '_jwt_access_token_';


    public function buildObj()
    {
        $obj = new BackchannelAuthenticationCompleteResponse();
        $obj->setAction(BackchannelAuthenticationCompleteAction::$NOTIFICATION)
            ->setResponseContent(self::RESPONSE_CONTENT)
            ->setClientId(self::CLIENT_ID)
            ->setClientIdAlias(self::CLIENT_ID_ALIAS)
            ->setClientIdAliasUsed(true)
            ->setClientName(self::CLIENT_NAME)
            ->setDeliveryMode(DeliveryMode::$POLL)
            ->setClientNotificationEndpoint(self::CLIENT_NOTIFICATION_ENDPOINT)
            ->setClientNotificationToken(self::CLIENT_NOTIFICATION_TOKEN)
            ->setAuthReqId(self::AUTH_REQ_ID)
            ->setAccessToken(self::ACCESS_TOKEN)
            ->setRefreshToken(self::REFRESH_TOKEN)
            ->setIdToken(self::ID_TOKEN)
            ->setAccessTokenDuration(self::ACCESS_TOKEN_DURATION)
            ->setRefreshTokenDuration(self::REFRESH_TOKEN_DURATION)
            ->setIdTokenDuration(self::ID_TOKEN_DURATION)
            ->setJwtAccessToken(self::JWT_ACCESS_TOKEN)
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
        $this->assertEquals('NOTIFICATION', $array['action']);

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

        // deliveryMode
        $this->assertArrayHasKey('deliveryMode', $array);
        $this->assertEquals('POLL', $array['deliveryMode']);

        // clientNotificationEndpoint
        $this->assertArrayHasKey('clientNotificationEndpoint', $array);
        $this->assertEquals(self::CLIENT_NOTIFICATION_ENDPOINT, $array['clientNotificationEndpoint']);

        // clientNotificationToken
        $this->assertArrayHasKey('clientNotificationToken', $array);
        $this->assertEquals(self::CLIENT_NOTIFICATION_TOKEN, $array['clientNotificationToken']);

        // authReqId
        $this->assertArrayHasKey('authReqId', $array);
        $this->assertEquals(self::AUTH_REQ_ID, $array['authReqId']);

        // accessToken
        $this->assertArrayHasKey('accessToken', $array);
        $this->assertEquals(self::ACCESS_TOKEN, $array['accessToken']);

        // refreshToken
        $this->assertArrayHasKey('refreshToken', $array);
        $this->assertEquals(self::REFRESH_TOKEN, $array['refreshToken']);

        // idToken
        $this->assertArrayHasKey('idToken', $array);
        $this->assertEquals(self::ID_TOKEN, $array['idToken']);

        // accessTokenDuration
        $this->assertArrayHasKey('accessTokenDuration', $array);
        $this->assertEquals(self::ACCESS_TOKEN_DURATION, $array['accessTokenDuration']);

        // refreshTokenDuration
        $this->assertArrayHasKey('refreshTokenDuration', $array);
        $this->assertEquals(self::REFRESH_TOKEN_DURATION, $array['refreshTokenDuration']);

        // idTokenDuration
        $this->assertArrayHasKey('idTokenDuration', $array);
        $this->assertEquals(self::ID_TOKEN_DURATION, $array['idTokenDuration']);

        // jwtAccessToken
        $this->assertArrayHasKey('jwtAccessToken', $array);
        $this->assertEquals(self::JWT_ACCESS_TOKEN, $array['jwtAccessToken']);

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
        $this->assertEquals(BackchannelAuthenticationCompleteAction::$NOTIFICATION, $obj->getAction());

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

        // deliveryMode
        $this->assertEquals(DeliveryMode::$POLL, $obj->getDeliveryMode());

        // clientNotificationEndpoint
        $this->assertEquals(self::CLIENT_NOTIFICATION_ENDPOINT, $obj->getClientNotificationEndpoint());

        // clientNotificationToken
        $this->assertEquals(self::CLIENT_NOTIFICATION_TOKEN, $obj->getClientNotificationToken());

        // authReqId
        $this->assertEquals(self::AUTH_REQ_ID, $obj->getAuthReqId());

        // accessToken
        $this->assertEquals(self::ACCESS_TOKEN, $obj->getAccessToken());

        // refreshToken
        $this->assertEquals(self::REFRESH_TOKEN, $obj->getRefreshToken());

        // idToken
        $this->assertEquals(self::ID_TOKEN, $obj->getIdToken());

        // accessTokenDuration
        $this->assertEquals(self::ACCESS_TOKEN_DURATION, $obj->getAccessTokenDuration());

        // refreshTokenDuration
        $this->assertEquals(self::REFRESH_TOKEN_DURATION, $obj->getRefreshTokenDuration());

        // idTokenDuration
        $this->assertEquals(self::ID_TOKEN_DURATION, $obj->getIdTokenDuration());

        // jwtAccessToken
        $this->assertEquals(self::JWT_ACCESS_TOKEN, $obj->getJwtAccessToken());

        // resources
        $resources = $obj->getResources();

        $this->assertTrue(is_array($resources));
        $this->assertCount(2, $resources);
        $this->assertEquals('resource-0', $resources[0]);
        $this->assertEquals('resource-1', $resources[1]);
    }
}
?>
