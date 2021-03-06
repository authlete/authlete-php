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
 * File containing the definition of TokenIssueResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/token/issue API.
 *
 * Authlete's `/api/auth/token/issue` API returns JSON which can be mapped
 * to this class. The token endpoint implementation should retrieve the
 * value of the `action` response parameter (which can be obtained by
 * `getAction()` method of this class) from the response and take the
 * following steps according to the value.
 *
 * When the value returned from `getAction()` method is
 * `TokenIssueAction::$INTERNAL_SERVER_ERROR`, it means that the request
 * from your system was wrong or that an error occurred in Authlete. In
 * either case, from a viewpoint of the client application, it is an error
 * on the server side. Therefore, the token endpoint implementation should
 * generate a response to the client application with the HTTP status of
 * `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the token endpoint
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * When the value returned from `getAction()` method is
 * `TokenIssueAction::$OK`, it means that Authlete's `/api/auth/token/issue`
 * API successfully generated an access token. The HTTP status of the
 * response returned to the client application must be `200 OK` and the
 * content type must be `application/json`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * contains the issued access token, so it can be used as the entity body
 * of the response. The following illustrates the response which the token
 * endpoint implementation should generate and return to the client
 * application.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 */
class TokenIssueResponse extends ApiResponse
{
    private $action                = null;  // \Authlete\Dto\TokenIssueAction
    private $responseContent       = null;  // string
    private $accessToken           = null;  // string
    private $accessTokenExpiresAt  = null;  // string or (64-bit) integer
    private $accessTokenDuration   = null;  // string or (64-bit) integer
    private $refreshToken          = null;  // string
    private $refreshTokenExpiresAt = null;  // string or (64-bit) integer
    private $refreshTokenDuration  = null;  // string or (64-bit) integer
    private $clientId              = null;  // string or (64-bit) integer
    private $clientIdAlias         = null;  // string
    private $clientIdAliasUsed     = false; // boolean
    private $subject               = null;  // string
    private $scopes                = null;  // array of string
    private $properties            = null;  // array of \Authlete\Dto\Property
    private $jwtAccessToken        = null;  // string
    private $accessTokenResources  = null;  // array of string


    /**
     * Get the next action that the token endpoint implementation should take.
     *
     * @return TokenIssueAction
     *     The next action that the token endpoint implementation should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the token endpoint implementation should take.
     *
     * @param TokenIssueAction $action
     *     The next action that the token endpoint implementation should take.
     *
     * @return TokenIssueAction
     *     `$this` object.
     */
    public function setAction(TokenIssueAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content which can be used as the entity body of the
     * response to the client application.
     *
     * @return string
     *     The response content.
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used as the entity body of the
     * response to the client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setResponseContent($responseContent)
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the newly issued access token.
     *
     * This method returns a non-null value only when `getAction()` method
     * returns `TokenIssueAction::$OK`.
     *
     * @return string
     *     The access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the newly issued access token.
     *
     * @param string $accessToken
     *     The access token.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setAccessToken($accessToken)
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the date at which the access token will expire.
     *
     * @return integer|string
     *     The date at which the access token will expire. The value is
     *     expressed in milliseconds since the Unix epoch (1970-Jan-1).
     */
    public function getAccessTokenExpiresAt()
    {
        return $this->accessTokenExpiresAt;
    }


    /**
     * Set the date at which the access token will expire.
     *
     * @param integer|string $expiresAt
     *     The date at which the access token will expire. The value
     *     should be expressed in milliseconds since the Unix epoch
     *     (1970-Jan-1).
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setAccessTokenExpiresAt($expiresAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->accessTokenExpiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the duration of the access token in seconds.
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
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setAccessTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the newly issued refresh token.
     *
     * This method returns a non-null value only when `getAction()` method
     * returns `TokenIssueAction::$OK` and the service is configured to
     * support the [refresh token flow](https://tools.ietf.org/html/rfc6749#section-6).
     *
     * If *"Refresh Token Continuous Use"* conifiguration parameter of the
     * service is `NO` (= `refreshTokenKept=false`), a new refresh token is
     * issued and the old refresh token used in the refresh token flow is
     * invalidated. On the contrary, if the configuration parameter is `YES`,
     * the refresh token itself is not refreshed.
     *
     * @return string
     *     The refresh token.
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }


    /**
     * Set the newly issued refresh token.
     *
     * @param string $refreshToken
     *     The refresh token.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setRefreshToken($refreshToken)
    {
        ValidationUtility::ensureNullOrString('$refreshToken', $refreshToken);

        $this->refreshToken = $refreshToken;

        return $this;
    }


    /**
     * Get the date at which the refresh token will expire.
     *
     * @return integer|string
     *     The date at which the refresh token will expire. The value is
     *     expressed in milliseconds since the Unix epoch (1970-Jan-1).
     */
    public function getRefreshTokenExpiresAt()
    {
        return $this->refreshTokenExpiresAt;
    }


    /**
     * Set the date at which the refresh token will expire.
     *
     * @param integer|string $expiresAt
     *     The date at which the refresh token will expire. The value
     *     should be expressed in milliseconds since the Unix epoch
     *     (1970-Jan-1).
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setRefreshTokenExpiresAt($expiresAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->refreshTokenExpiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the duration of the refresh token in seconds.
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
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setRefreshTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->refreshTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the ID of the client application associated with the access token.
     *
     * @return integer|string
     *     The client ID.
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * Set the ID of the client application associated with the access token.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setClientId($clientId)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client ID alias.
     *
     * If no alias is assigned to the client application, this method returns
     * `null`.
     *
     * @return string
     *     The client ID alias.
     */
    public function getClientIdAlias()
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the client ID alias.
     *
     * @param string $alias
     *     The client ID alias.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setClientIdAlias($alias)
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias was used
     * when the token request was made.
     *
     * @return boolean
     *     `true` if the client ID alias was used in the token request.
     */
    public function isClientIdAliasUsed()
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether the client ID alias was used
     * when the token request was made.
     *
     * @param boolean $used
     *     `true` to indicate that the client ID alias was used in the
     *     token request.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setClientIdAliasUsed($used)
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user (= resource
     * owner) of the access token.
     *
     * @return string
     *     The subject of the end-user.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user (= resource
     * owner) of the access token.
     *
     * @param string $subject
     *     The subject of the end-user.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setSubject($subject)
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the scopes covered by the access token.
     *
     * @return string[]
     *     The scopes covered by the access token.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set the scopes covered by the access token.
     *
     * @param string[] $scopes
     *     The scopes covered by the access token.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the properties associated with the access token.
     *
     * @return Property[]
     *     The properties associated with the access token.
     */
    public function getProperties()
    {
        return $this->properties;
    }


    /**
     * Set the properties associated with the access token.
     *
     * @param Property[] $properties
     *     The properties associated with the access token.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     */
    public function setProperties(array $properties = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', $properties, __NAMESPACE__ . '\Property');

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get the newly issued access token in JWT format.
     *
     * If the authorization server is configured to issue JWT-based access
     * tokens (if `getAccessTokenSignAlg()` of `Service` returns a non-null
     * value), a JWT-based access token is issued along with the original
     * random-string one.
     *
     * @return string
     *     The newly issued access token in JWT format.
     *
     * @since 1.8
     */
    public function getJwtAccessToken()
    {
        return $this->jwtAccessToken;
    }


    /**
     * Set the newly issued access token in JWT format.
     *
     * If the authorization server is configured to issue JWT-based access
     * tokens (if `getAccessTokenSignAlg()` of `Service` returns a non-null
     * value), a JWT-based access token is issued along with the original
     * random-string one.
     *
     * @param string $jwtAccessToken
     *     The newly issued access token in JWT format.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setJwtAccessToken($jwtAccessToken)
    {
        ValidationUtility::ensureNullOrString('$jwtAccessToken', $jwtAccessToken);

        $this->jwtAccessToken = $jwtAccessToken;

        return $this;
    }


    /**
     * Get the target resources of the access token.
     *
     * @return string[]
     *     The target resources of the access token.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function getAccessTokenResources()
    {
        return $this->accessTokenResources;
    }


    /**
     * Set the target resources of the access token.
     *
     * @param string[] $resources
     *     The target resources of the access token.
     *
     * @return TokenIssueResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function setAccessTokenResources(array $resources = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$resources', $resources);

        $this->accessTokenResources = $resources;

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

        $array['action']                = LanguageUtility::toString($this->action);
        $array['responseContent']       = $this->responseContent;
        $array['accessToken']           = $this->accessToken;
        $array['accessTokenExpiresAt']  = LanguageUtility::orZero($this->accessTokenExpiresAt);
        $array['accessTokenDuration']   = LanguageUtility::orZero($this->accessTokenDuration);
        $array['refreshToken']          = $this->refreshToken;
        $array['refreshTokenExpiresAt'] = LanguageUtility::orZero($this->refreshTokenExpiresAt);
        $array['refreshTokenDuration']  = LanguageUtility::orZero($this->refreshTokenDuration);
        $array['clientId']              = $this->clientId;
        $array['clientIdAlias']         = $this->clientIdAlias;
        $array['subject']               = $this->subject;
        $array['scopes']                = $this->scopes;
        $array['properties']            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['jwtAccessToken']        = $this->jwtAccessToken;
        $array['accessTokenResources']  = $this->accessTokenResources;
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
            TokenIssueAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // accessTokenExpiresAt
        $this->setAccessTokenExpiresAt(
            LanguageUtility::getFromArray('accessTokenExpiresAt', $array));

        // accessTokenDuration
        $this->setAccessTokenDuration(
            LanguageUtility::getFromArray('accessTokenDuration', $array));

        // refreshToken
        $this->setRefreshToken(
            LanguageUtility::getFromArray('refreshToken', $array));

        // refreshTokenExpiresAt
        $this->setRefreshTokenExpiresAt(
            LanguageUtility::getFromArray('refreshTokenExpiresAt', $array));

        // refreshTokenDuration
        $this->setRefreshTokenDuration(
            LanguageUtility::getFromArray('refreshTokenDuration', $array));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // clientIdAlias
        $this->setClientIdAlias(
            LanguageUtility::getFromArray('clientIdAlias', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable($_properties, __NAMESPACE__ . '\Property');
        $this->setProperties($_properties);

        // jwtAccessToken
        $this->setJwtAccessToken(
            LanguageUtility::getFromArray('jwtAccessToken', $array));

        // accessTokenResources
        $_access_token_resources = LanguageUtility::getFromArray('accessTokenResources', $array);
        $this->setAccessTokenResources($_access_token_resources);
    }
}
?>
