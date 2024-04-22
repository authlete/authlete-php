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
 * File containing the definition of TokenCreateResponse class.
 */


namespace Authlete\Dto;


use Authlete\Types\GrantType;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/token/create API.
 *
 * Authlete's `/api/auth/token/create` API returns JSON which can be mapped
 * to this class. The first step that a caller should take is to retrieve
 * the value of the `action` response parameter (which can be obtained by
 * `getAction()` method of this class) from the response.
 *
 * When the value returned from `getAction()` method is
 * `TokenCreateAction::$INTERNAL_SERVER_ERROR`, it means that an error
 * occurred on Authlete side.
 *
 * When the value returned from `getAction()` method is
 * `TokenCreateAction::$BAD_REQUEST`, it means that the request from the
 * caller was wrong. For example, this happens when the `grantType` request
 * parameter is missing.
 *
 * When the value returned from `getAction()` method is
 * `TokenCreateAction::$FORBIDDEN`, it means that the request from the caller
 * is not allowed. For example, this happens when the client application
 * identified by the `clientId` request parameter does not belong to the
 * service identified by the API key used for the API call.
 *
 * When the value returned from `getAction()` method is
 * `TokenCreateAction::$OK`, it means that everything was processed
 * successfully and an access token and optionally a refresh token were
 * issued. So, in short, when the value returned from `getAction()` method
 * is `TokenCreateAction::$OK`, you can retrieve the values of a new access
 * token and an optional refresh token from `getAccessToken()` method and
 * `getRefreshToken()` method.
 */
class TokenCreateResponse extends ApiResponse
{
    private ?TokenCreateAction $action  = null;
    private ?GrantType $grantType       = null;
    private string|int|null $clientId   = null;
    private ?string $subject            = null;
    private ?array $scopes              = null;  // array of string
    private ?string $accessToken        = null;
    private ?string $tokenType          = null;
    private string|int|null $expiresIn  = null;
    private string|int|null $expiresAt  = null;
    private ?string $refreshToken       = null;
    private ?array $properties          = null;  // array of \Authlete\Dto\Property


    /**
     * Get the code which indicates how the response from Authlete's
     * /api/auth/token/create API should be interpreted.
     *
     * @return TokenCreateAction|null
     *     The code which indicates how the response should be interpreted.
     */
    public function getAction(): ?TokenCreateAction
    {
        return $this->action;
    }


    /**
     * Set the code which indicates how the response from Authlete's
     * /api/auth/token/create API should be interpreted.
     *
     * @param TokenCreateAction|null $action
     *     The code which indicates how the response should be interpreted.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setAction(TokenCreateAction $action = null): TokenCreateResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the grant type emulated for the newly issued access token.
     *
     * @return GrantType|null
     *     The grant type.
     */
    public function getGrantType(): ?GrantType
    {
        return $this->grantType;
    }


    /**
     * Set the grant type emulated for the newly issued access token.
     *
     * @param GrantType|null $grantType
     *     The grant type.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setGrantType(GrantType $grantType = null): TokenCreateResponse
    {
        $this->grantType = $grantType;

        return $this;
    }


    /**
     * Get the client ID associated with the newly issued access token.
     *
     * @return integer|string|null
     *     The client ID.
     */
    public function getClientId(): int|string|null
    {
        return $this->clientId;
    }


    /**
     * Set the client ID associated with the newly issued access token.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setClientId(int|string $clientId): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user associated with
     * the newly issued access token.
     *
     * @return string|null
     *     The subject of the end-user. This response parameter is `null`
     *     when the grant type is `GrantType::$CLIENT_CREDENTIALS`.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user associated with
     * the newly issued access token.
     *
     * @param string $subject
     *     The subject of the end-user.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setSubject(string $subject): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the scopes associated with the newly issued access token.
     *
     * @return array|null
     *     The scopes.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set the scopes associated with the newly issued access token.
     *
     * @param string[] $scopes
     *     The scopes.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the value of the newly issued access token.
     *
     * @return string|null
     *     The access token.
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }


    /**
     * Set the value of the newly issued access token.
     *
     * @param string $accessToken
     *     The access token.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setAccessToken(string $accessToken): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the token type of the newly issued access token.
     *
     * @return string|null
     *     The token type.
     */
    public function getTokenType(): ?string
    {
        return $this->tokenType;
    }


    /**
     * Set the token type of the newly issued access token.
     *
     * @param string $tokenType
     *     The token type.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setTokenType(string $tokenType): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrString('$tokenType', $tokenType);

        $this->tokenType = $tokenType;

        return $this;
    }


    /**
     * Get the duration of the newly issued access token in seconds.
     *
     * @return integer|string|null
     *     The duration of the access token in seconds.
     */
    public function getExpiresIn(): int|string|null
    {
        return $this->expiresIn;
    }


    /**
     * Set the duration of the newly issued access token in seconds.
     *
     * @param integer|string $expiresIn
     *     The duration of the access token in seconds.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setExpiresIn(int|string $expiresIn): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresIn', $expiresIn);

        $this->expiresIn = $expiresIn;

        return $this;
    }


    /**
     * Get the date at which the newly issued access token will expire.
     *
     * @return integer|string|null
     *     The date at which the access token will expire. The value is
     *     expressed in milliseconds since the Unix epoch (1970-Jan-1).
     */
    public function getExpiresAt(): int|string|null
    {
        return $this->expiresAt;
    }


    /**
     * Set the date at which the newly issued access token will expire.
     *
     * @param integer|string $expiresAt
     *     The date at which the access token will expire.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setExpiresAt(int|string $expiresAt): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->expiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the value of the newly issued refresh token.
     *
     * This is `null` when the grant type is either `GrantType::$IMPLICIT` or
     * `GrantType::$CLIENT_CREDENTIALS` or when the refresh token flow is
     * disabled by the service configuration.
     *
     * @return string|null
     *     The value of the newly issued refresh token.
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }


    /**
     * Set the value of the newly issued refresh token.
     *
     * @param string $refreshToken
     *     The value of the newly issued refresh token.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setRefreshToken(string $refreshToken): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrString('$refreshToken', $refreshToken);

        $this->refreshToken = $refreshToken;

        return $this;
    }


    /**
     * Get properties that are associated with the newly issued access token.
     *
     * @return array|null
     *     Properties associated with the access token.
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }


    /**
     * Set properties that are associated with the newly issued access token.
     *
     * @param Property[] $properties
     *     Properties associated with the access token.
     *
     * @return TokenCreateResponse
     *     `$this` object.
     */
    public function setProperties(array $properties = null): TokenCreateResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

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
    public function copyToArray(array &$array): void
    {
        parent::copyToArray($array);

        $array['action']       = LanguageUtility::toString($this->action);
        $array['grantType']    = LanguageUtility::toString($this->grantType);
        $array['clientId']     = $this->clientId;
        $array['subject']      = $this->subject;
        $array['scopes']       = $this->scopes;
        $array['accessToken']  = $this->accessToken;
        $array['tokenType']    = $this->tokenType;
        $array['expiresIn']    = LanguageUtility::orZero($this->expiresIn);
        $array['expiresAt']    = LanguageUtility::orZero($this->expiresAt);
        $array['refreshToken'] = $this->refreshToken;
        $array['properties']   = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyFromArray(array &$array): void
    {
        parent::copyFromArray($array);

        // action
        $this->setAction(
            TokenCreateAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // grantType
        $this->setGrantType(
            GrantType::valueOf(
                LanguageUtility::getFromArray('grantType', $array)));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // tokenType
        $this->setTokenType(
            LanguageUtility::getFromArray('tokenType', $array));

        // expiresIn
        $this->setExpiresIn(
            LanguageUtility::getFromArray('expiresIn', $array));

        // expiresAt
        $this->setExpiresAt(
            LanguageUtility::getFromArray('expiresAt', $array));

        // refreshToken
        $this->setRefreshToken(
            LanguageUtility::getFromArray('refreshToken', $array));

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);
    }
}

