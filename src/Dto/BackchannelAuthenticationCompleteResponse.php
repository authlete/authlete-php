<?php
//
// Copyright (C) 2018-2021 Authlete, Inc.
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


/**
 * File containing the definition of BackchannelAuthenticationCompleteResponse class.
 */


namespace Authlete\Dto;


use Authlete\Types\DeliveryMode;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/backchannel/authentication/complete API.
 *
 * Authlete's `/api/backchannel/authentication/complete` API returns JSON
 * which can be mapped to this class. The authorization server implementation
 * should retrieve the value of the `action` response parameter (which can be
 * obtained by `getAction()` method of this class) from the response and take
 * the following steps according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationCompleteAction::$NOTIFICATION`, it means that the
 * authorization server must send a notification to the client notification
 * endpoint.
 *
 * According to the CIBA Core specification, the notification is an HTTP POST
 * request whose request body is JSON and whose `Authorization` header contains
 * the client notification token, which was included in the backchannel
 * authentication request as the value of the `client_notification_token`
 * request parameter, as a bearer token.
 *
 * When the backchannel token delivery mode is "ping", the request body of the
 * notification is JSON which contains the `auth_req_id` property only.
 * When the backchannel token delivery mode is "push", the request body will
 * additionally contain an access token, an ID token and other properties.
 * Note that when the backchannel token delivery mode is "poll", a notification
 * does not have to be sent to the client notification endpoint.
 *
 * In error cases, in the "ping" mode, however, the content of a notification
 * is not different from the content in successful cases. That is, the
 * notification contains the `auth_req_id` property only. The client will know
 * the error when it accesses the token endpoint. On the other hand, in the
 * "push" mode, in error cases, the content of a notification will include the
 * `error` property instead of an access token and an ID token. The client will
 * know the error by detecting that `error` is included in the notification.
 *
 * In any case, the `getResponseContent()` method returns JSON which can be
 * used as the request body of the notification.
 *
 * The client notification endpoint that the notification should be sent to can
 * be obtained by calling the `getClientNotificationEndpoint()` method.
 * Likewise, the client notification token that the notification should include
 * as a bearer token can be obtained by calling the
 * `getClientNotificationToken()` method. With these methods, the notification
 * can be built like the following.
 *
 * ```
 * POST (The path of getClientNotificationEndpoint()) HTTP/1.1
 * HOST: (The host of getClientNotificationEndpoint())
 * Authorization: Bearer (The value returned from getClientNotificationToken())
 * Content-Type: application/json
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationCompleteAction::$NO_ACTION`, it means that the
 * authorization server does not have to take any immediate action.
 *
 * `NO_ACTION` is returned when the backchannel token delivery mode is "poll".
 * In this case, the client will receive the final result at the token
 * endpoint.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationCompleteAction::$SERVER_ERROR`, it means either
 * (1) that the request from the authorization server to Authlete was wrong,
 * or (2) that an error occurred on Authlete side.
 *
 * When the backchannel token delivery mode is "ping" or "push", `SERVER_ERROR`
 * is used only when an error is detected before the record of the ticket
 * (which is included in the API call to
 * `/api/backchannel/authentication/complete`) is retrieved from the database
 * successfully. If an error is detected after the record ofthe ticket is
 * retrieved from the database, `NOTIFICATION` is used instead of
 * `SERVER_ERROR`.
 *
 * When the backchannel token delivery mode is "poll", `SERVER_ERROR` is used
 * regardless of whether it is before or after the record of the ticket is
 * retrieved from the database.
 *
 * @since 1.8
 */
class BackchannelAuthenticationCompleteResponse extends ApiResponse
{
    private $action                     = null;  // \Authlete\Dto\BackchannelAuthenticationCompleteAction
    private $responseContent            = null;  // string
    private $clientId                   = null;  // string or (64-bit) integer
    private $clientIdAlias              = null;  // string
    private $clientIdAliasUsed          = false; // boolean
    private $clientName                 = null;  // string
    private $deliveryMode               = null;  // \Authlete\Types\DeliveryMode
    private $clientNotificationEndpoint = null;  // string
    private $clientNotificationToken    = null;  // string
    private $authReqId                  = null;  // string
    private $accessToken                = null;  // string
    private $refreshToken               = null;  // string
    private $idToken                    = null;  // string
    private $accessTokenDuration        = null;  // string or (64-bit) integer
    private $refreshTokenDuration       = null;  // string or (64-bit) integer
    private $idTokenDuration            = null;  // string or (64-bit) integer
    private $jwtAccessToken             = null;  // string
    private $resources                  = null;  // array of string


    /**
     * Get the next action that the authorization server should take.
     *
     * @return BackchannelAuthenticationCompleteAction
     *     The next action that the authorization server should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the authorization server should take.
     *
     * @param BackchannelAuthenticationCompleteAction $action
     *     The next action that the authorization server should take.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setAction(BackchannelAuthenticationCompleteAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the content of the notification.
     *
     * When `getAction()` returns `NOTIFICATION`, this method returns JSON which
     * should be used as the request body of the notification.
     *
     * In successful cases, when the backchannel token delivery mode is "ping",
     * the JSON contains `auth_req_id`. On the other hand, when the backchannel
     * token delivery mode is "push", the JSON contains an access token, an ID
     * token, and optionally a refresh token (and some other properties).
     *
     * @return string
     *     The content of the notification.
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }


    /**
     * Set the content of the notification.
     *
     * @param string $responseContent
     *     The content of the notification.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setResponseContent($responseContent)
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the client ID of the client application that has made the
     * backchannel authentication request.
     *
     * @return integer|string
     *     The client ID.
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * Set the client ID of the client application that has made the
     * backchannel authentication request.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setClientId($clientId)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client ID alias of the client application that has made the
     * backchannel authentication request.
     *
     * @return string
     *     The client ID alias.
     */
    public function getClientIdAlias()
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the client ID alias of the client application that has made the
     * backchannel authentication request.
     *
     * @param string $alias
     *     The client ID alias.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setClientIdAlias($alias)
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias was used in
     * the backchannel authentication request.
     *
     * @return boolean
     *     `true` if the client ID alias was used in the request.
     */
    public function isClientIdAliasUsed()
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether the client ID alias was used in
     * the backchannel authentication request.
     *
     * @param boolean $used
     *     `true` to indicate that the client ID alias was used in the request.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setClientIdAliasUsed($used)
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the name of the client application which has made the backchannel
     * authentication request.
     *
     * @return string
     *     The name of the client application.
     */
    public function getClientName()
    {
        return $this->clientName;
    }


    /**
     * Set the name of the client application which has made the backchannel
     * authentication request.
     *
     * @param string $name
     *     The name of the client application.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setClientName($name)
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->clientName = $name;

        return $this;
    }


    /**
     * Get the backchannel token delivery mode.
     *
     * @return DeliveryMode
     *     The backchannel token delivery mode.
     */
    public function getDeliveryMode()
    {
        return $this->deliveryMode;
    }


    /**
     * Set the backchannel token delivery mode.
     *
     * @param DeliveryMode $mode
     *     The backchannel token delivery mode.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setDeliveryMode(DeliveryMode $mode = null)
    {
        $this->deliveryMode = $mode;

        return $this;
    }


    /**
     * Get the client notification endpoint to which a notification needs to be
     * sent.
     *
     * @return string
     *     The client notification endpoint.
     */
    public function getClientNotificationEndpoint()
    {
        return $this->clientNotificationEndpoint;
    }


    /**
     * Set the client notification endpoint to which a notification needs to be
     * sent.
     *
     * @param string $endpoint
     *     The client notification endpoint.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setClientNotificationEndpoint($endpoint)
    {
        ValidationUtility::ensureNullOrString('$endpoint', $endpoint);

        $this->clientNotificationEndpoint = $endpoint;

        return $this;
    }


    /**
     * Get the client notification token which needs to be embedded as a
     * `Bearer` token in the `Authorization` header in the notification.
     *
     * @return string
     *     The client notification token.
     */
    public function getClientNotificationToken()
    {
        return $this->clientNotificationToken;
    }


    /**
     * Set the client notification token which needs to be embedded as a
     * `Bearer` token in the `Authorization` header in the notification.
     *
     * @param string $token
     *     The client notification token.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setClientNotificationToken($token)
    {
        ValidationUtility::ensureNullOrString('$token', $token);

        $this->clientNotificationToken = $token;

        return $this;
    }


    /**
     * Get the value of the `auth_req_id` which is associated with the ticket.
     *
     * @return string
     *     The value of `auth_req_id`.
     */
    public function getAuthReqId()
    {
        return $this->authReqId;
    }


    /**
     * Set the value of the `auth_req_id` which is associated with the ticket.
     *
     * @param string $authReqId
     *     The value of `auth_req_id`.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setAuthReqId($authReqId)
    {
        ValidationUtility::ensureNullOrString('$authReqId', $authReqId);

        $this->authReqId = $authReqId;

        return $this;
    }


    /**
     * Get the issued access token. This method returns a non-null value only
     * when the backchannel token delivery mode is "push" and an access token
     * has been issued successfully.
     *
     * @return string
     *     The issued access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the issued access token.
     *
     * @param string $accessToken
     *     The issued access token.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setAccessToken($accessToken)
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the issued refresh token. This method returns a non-null value only
     * when the backchannel token delivery mode is "push" and a refresh token
     * has been issued successfully.
     *
     * Note that refresh tokens are not issued if the service does not support
     * the refresh token flow.
     *
     * @return string
     *     The issued refresh token.
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }


    /**
     * Set the issued refresh token.
     *
     * @param string $refreshToken
     *     The issued refresh token.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setRefreshToken($refreshToken)
    {
        ValidationUtility::ensureNullOrString('$refreshToken', $refreshToken);

        $this->refreshToken = $refreshToken;

        return $this;
    }


    /**
     * Get the issued ID token. This method returns a non-null value only
     * when the backchannel token delivery mode is "push" and an ID token
     * has been issued successfully.
     *
     * @return string
     *     The issued ID token.
     */
    public function getIdToken()
    {
        return $this->idToken;
    }


    /**
     * Set the issued ID token.
     *
     * @param string $idToken
     *     The issued ID token.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setIdToken($idToken)
    {
        ValidationUtility::ensureNullOrString('$idToken', $idToken);

        $this->idToken = $idToken;

        return $this;
    }


    /**
     * Get the duration of the access token in seconds. If an access token has
     * not been issued, this method returns 0.
     *
     * @return integer|string
     *     The duration of the access token in seconds.
     */
    public function getAccessTokenDuration()
    {
        return $this->accessTokenDuration;
    }


    /**
     * Set the duration of the access token in seconds.
     *
     * @param integer|string $duration
     *     The duration of the access token in seconds.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setAccessTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of the refresh token in seconds. If a refresh token has
     * not been issued, this method returns 0.
     *
     * @return integer|string
     *     The duration of the refresh token in seconds.
     */
    public function getRefreshTokenDuration()
    {
        return $this->refreshTokenDuration;
    }


    /**
     * Set the duration of the refresh token in seconds.
     *
     * @param integer|string $duration
     *     The duration of the refresh token in seconds.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setRefreshTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->refreshTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of the ID token in seconds. If an ID token has not
     * been issued, this method returns 0.
     *
     * @return integer|string
     *     The duration of the ID token in seconds.
     */
    public function getIdTokenDuration()
    {
        return $this->idTokenDuration;
    }


    /**
     * Set the duration of the ID token in seconds.
     *
     * @param integer|string $duration
     *     The duration of the ID token in seconds.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setIdTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->idTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the newly issued access token in JWT format.
     *
     * If the authorization server is configured to issue JWT-based access
     * tokens (= if `Service.getAccessTokenSignAlg()` returns a non-null
     * value), a JWT-based access token is issued along with the original
     * random-string one.
     *
     * @return string
     *     The newly issued access token in JWT format.
     */
    public function getJwtAccessToken()
    {
        return $this->jwtAccessToken;
    }


    /**
     * Set the newly issued access token in JWT format.
     *
     * @param string $jwtAccessToken
     *     The newly issued access token in JWT format.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     */
    public function setJwtAccessToken($jwtAccessToken)
    {
        ValidationUtility::ensureNullOrString('$jwtAccessToken', $jwtAccessToken);

        $this->jwtAccessToken = $jwtAccessToken;

        return $this;
    }


    /**
     * Get the resources specified by the `resource` request parameters or by
     * the `resource` property in the request object in the preceding
     * backchannel authentication request. If both are given, the values in the
     * request object take precedence.
     *
     * @return string[]
     *     The target resources.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     */
    public function getResources()
    {
        return $this->resources;
    }


    /**
     * Set the resources specified by the `resource` request parameters or by
     * the `resource` property in the request object in the preceding
     * backchannel authentication request. If both are given, the values in the
     * request object take precedence.
     *
     * @param string[] $resources
     *     The target resources.
     *
     * @return BackchannelAuthenticationCompleteResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     */
    public function setResources(array $resources = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$resources', $resources);

        $this->resources = $resources;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyToArray(array &$array)
    {
        parent::copyToArray($array);

        $array['action']                     = LanguageUtility::toString($this->action);
        $array['responseContent']            = $this->responseContent;
        $array['clientId']                   = $this->clientId;
        $array['clientIdAlias']              = $this->clientIdAlias;
        $array['clientIdAliasUsed']          = $this->clientIdAliasUsed;
        $array['clientName']                 = $this->clientName;
        $array['deliveryMode']               = LanguageUtility::toString($this->deliveryMode);
        $array['clientNotificationEndpoint'] = $this->clientNotificationEndpoint;
        $array['clientNotificationToken']    = $this->clientNotificationToken;
        $array['authReqId']                  = $this->authReqId;
        $array['accessToken']                = $this->accessToken;
        $array['refreshToken']               = $this->refreshToken;
        $array['idToken']                    = $this->idToken;
        $array['accessTokenDuration']        = LanguageUtility::orZero($this->accessTokenDuration);
        $array['refreshTokenDuration']       = LanguageUtility::orZero($this->refreshTokenDuration);
        $array['idTokenDuration']            = LanguageUtility::orZero($this->idTokenDuration);
        $array['jwtAccessToken']             = $this->jwtAccessToken;
        $array['resources']                  = $this->resources;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyFromArray(array &$array)
    {
        parent::copyFromArray($array);

        // action
        $this->setAction(
            BackchannelAuthenticationCompleteAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // clientIdAlias
        $this->setClientIdAlias(
            LanguageUtility::getFromArray('clientIdAlias', $array));

        // clientIdAliasUsed
        $this->setClientIdAliasUsed(
            LanguageUtility::getFromArrayAsBoolean('clientIdAlias', $array));

        // clientName
        $this->setClientName(
            LanguageUtility::getFromArray('clientName', $array));

        // deliveryMode
        $this->setDeliveryMode(
            DeliveryMode::valueOf(
                LanguageUtility::getFromArray('deliveryMode', $array)));

        // clientNotificationEndpoint
        $this->setClientNotificationEndpoint(
            LanguageUtility::getFromArray('clientNotificationEndpoint', $array));

        // clientNotificationToken
        $this->setClientNotificationToken(
            LanguageUtility::getFromArray('clientNotificationToken', $array));

        // authReqId
        $this->setAuthReqId(
            LanguageUtility::getFromArray('authReqId', $array));

        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // refreshToken
        $this->setRefreshToken(
            LanguageUtility::getFromArray('refreshToken', $array));

        // idToken
        $this->setIdToken(
            LanguageUtility::getFromArray('idToken', $array));

        // accessTokenDuration
        $this->setAccessTokenDuration(
            LanguageUtility::getFromArray('accessTokenDuration', $array));

        // refreshTokenDuration
        $this->setRefreshTokenDuration(
            LanguageUtility::getFromArray('refreshTokenDuration', $array));

        // idTokenDuration
        $this->setIdTokenDuration(
            LanguageUtility::getFromArray('idTokenDuration', $array));

        // jwtAccessToken
        $this->setJwtAccessToken(
            LanguageUtility::getFromArray('jwtAccessToken', $array));

        // resources
        $_resources = LanguageUtility::getFromArray('resources', $array);
        $this->setResources($_resources);
    }
}
?>
