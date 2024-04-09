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


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Dto\BackchannelAuthenticationAction;
use Authlete\Dto\BackchannelAuthenticationResponse;
use Authlete\Dto\Scope;
use Authlete\Types\DeliveryMode;
use Authlete\Types\UserIdentificationHintType;


class BackchannelAuthenticationResponseTest extends TestCase
{
    private const RESPONSE_CONTENT          = '_response_content_';
    private const CLIENT_ID                 = 1;
    private const CLIENT_ID_ALIAS           = '_client_id_alias_';
    private const CLIENT_NAME               = '_client_name_';
    private const CLIENT_NOTIFICATION_TOKEN = '_client_notification_token';
    private const HINT                      = '_hint_';
    private const SUB                       = '_sub_';
    private const BINDING_MESSAGE           = '_binding_message_';
    private const USER_CODE                 = '_user_code_';
    private const REQUESTED_EXPIRY          = 2;
    private const REQUEST_CONTEXT           = '_request_context_';
    private const TICKET                    = '_ticket_';


    public function buildObj(): BackchannelAuthenticationResponse
    {
        $obj = new BackchannelAuthenticationResponse();
        $obj->setAction(BackchannelAuthenticationAction::USER_IDENTIFICATION)
            ->setResponseContent(self::RESPONSE_CONTENT)
            ->setClientId(self::CLIENT_ID)
            ->setClientIdAlias(self::CLIENT_ID_ALIAS)
            ->setClientIdAliasUsed(true)
            ->setClientName(self::CLIENT_NAME)
            ->setDeliveryMode(DeliveryMode::POLL)
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
            ->setClientNotificationToken(self::CLIENT_NOTIFICATION_TOKEN)
            ->setAcrs(
                array(
                    "acr-0",
                    "acr-1"
                )
            )
            ->setHintType(UserIdentificationHintType::LOGIN_HINT)
            ->setHint(self::HINT)
            ->setSub(self::SUB)
            ->setBindingMessage(self::BINDING_MESSAGE)
            ->setUserCode(self::USER_CODE)
            ->setUserCodeRequired(true)
            ->setRequestedExpiry(self::REQUESTED_EXPIRY)
            ->setRequestContext(self::REQUEST_CONTEXT)
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
            ->setTicket(self::TICKET)
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
        $this->assertEquals('USER_IDENTIFICATION', $array['action']);

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

        // clientNotificationToken
        $this->assertArrayHasKey('clientNotificationToken', $array);
        $this->assertEquals(self::CLIENT_NOTIFICATION_TOKEN, $array['clientNotificationToken']);

        // acrs
        $this->assertArrayHasKey('acrs', $array);
        $acrs = $array['acrs'];

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr-0', $acrs[0]);
        $this->assertEquals('acr-1', $acrs[1]);

        // hintType
        $this->assertArrayHasKey('hintType', $array);
        $this->assertEquals('LOGIN_HINT', $array['hintType']);

        // hint
        $this->assertArrayHasKey('hint', $array);
        $this->assertEquals(self::HINT, $array['hint']);

        // sub
        $this->assertArrayHasKey('sub', $array);
        $this->assertEquals(self::SUB, $array['sub']);

        // bindingMessage
        $this->assertArrayHasKey('bindingMessage', $array);
        $this->assertEquals(self::BINDING_MESSAGE, $array['bindingMessage']);

        // userCode
        $this->assertArrayHasKey('userCode', $array);
        $this->assertEquals(self::USER_CODE, $array['userCode']);

        // userCodeRequired
        $this->assertArrayHasKey('userCodeRequired', $array);
        $this->assertTrue($array['userCodeRequired']);

        // requestedExpiry
        $this->assertArrayHasKey('requestedExpiry', $array);
        $this->assertEquals(self::REQUESTED_EXPIRY, $array['requestedExpiry']);

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

        // ticket
        $this->assertArrayHasKey('ticket', $array);
        $this->assertEquals(self::TICKET, $array['ticket']);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // action
        $this->assertEquals(BackchannelAuthenticationAction::USER_IDENTIFICATION, $obj->getAction());

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
        $this->assertEquals(DeliveryMode::POLL, $obj->getDeliveryMode());

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

        // clientNotificationToken
        $this->assertEquals(self::CLIENT_NOTIFICATION_TOKEN, $obj->getClientNotificationToken());

        // acrs
        $acrs = $obj->getAcrs();

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr-0', $acrs[0]);
        $this->assertEquals('acr-1', $acrs[1]);

        // hintType
        $this->assertEquals(UserIdentificationHintType::LOGIN_HINT, $obj->getHintType());

        // hint
        $this->assertEquals(self::HINT, $obj->getHint());

        // sub
        $this->assertEquals(self::SUB, $obj->getSub());

        // bindingMessage
        $this->assertEquals(self::BINDING_MESSAGE, $obj->getBindingMessage());

        // userCode
        $this->assertEquals(self::USER_CODE, $obj->getUserCode());

        // userCodeRequired
        $this->assertTrue($obj->isUserCodeRequired());

        // requestedExpiry
        $this->assertEquals(self::REQUESTED_EXPIRY, $obj->getRequestedExpiry());

        // requestContext
        $this->assertEquals(self::REQUEST_CONTEXT, $obj->getRequestContext());

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

        // ticket
        $this->assertEquals(self::TICKET, $obj->getTicket());
    }
}
