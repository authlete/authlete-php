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
 * File containing the definition of TokenResponse class.
 */


namespace Authlete\Dto;


use Authlete\Types\GrantType;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/token API.
 *
 * Authlete's `/api/auth/token` API returns JSON which can be mapped to this
 * class. The token endpoint implementation should retrieve the value of the
 * `action` response parameter (which can be obtained by `getAction()` method
 * of this class) from the response and take the following steps according to
 * the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `TokenAction::$INVALID_CLIENT`, it means that authentication of the client
 * failed. In this case, the HTTP status of the response to the client
 * application should be either `400 Bad Request` or `401 Unauthorized`. This
 * requirement comes from
 * [5.2. Error Response](https://tools.ietf.org/html/rfc6749#section-5.2) of
 * [RFC 6749](https://tools.ietf.org/html/rfc6749). The description about
 * `invalid_client` shown below is an excerpt from RFC 6749.
 *
 * > Client authentication failed (e.g., unknown client, no client
 * > authentication included, or unsupported authentication method). The
 * > authorization server MAY return an HTTP 401 (Unauthorized) status code
 * > to indicate which HTTP authentication schemes are supported. If the
 * > client attempted to authenticate via the "Authorization" request header
 * > field, the authorization server MUST respond with an HTTP 401
 * > (Unauthorized) status code and include the "WWW-Authenticate" response
 * > header field matching the authentication scheme used by the client.
 *
 * In either case, the JSON string returned from `getResponseContent()`
 * method can be used as the entity body of the response to the client
 * application. The following illustrates the response which the token
 * endpoint implementation should generate and return to the client
 * application.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ```
 * HTTP/1.1 401 Unauthorized
 * WWW-Authenticate: (challenge)
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `TokenAction::$INTERNAL_SERVER_ERROR`, it means that the request from your
 * system was wrong or that an error occurred in Authlete. In either case,
 * from a viewpoint of the client application, it is an error on the server
 * side. Therefore, the token endpoint implementation should generate a
 * response to the client application with the HTTP status of
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
 * ---
 *
 * When the value returned from `getAction()` method is
 * `TokenAction::$BAD_REQUEST`, it means that the request from the client
 * application is invalid. The HTTP status of the response returned to the
 * client application must be `400 Bad Request` and the content type must be
 * `application/json`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the token endpoint
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `TokenAction::$PASSWORD`, it means that the request from the client
 * application is valid and the value of the `grant_type` request parameter
 * was `password`. This indicates that the flow is
 * [Resource Owner Password Credentials flow](https://tools.ietf.org/html/rfc6749#section-4.3).
 *
 * In this case, `getUsername()` method returns the value of the `username`
 * request parameter and `getPassword()` method returns the value of the
 * `password` request parameter which were contained in the token request
 * from the client application. The token endpoint implementation must
 * validate the credentials of the resource owner (= end-user) and take
 * either of the actions below according to the validation result.
 *
 * 1. When the credentials are valid, call Authlete's `/api/auth/token/issue`
 *    API to generate an access. The API requires a `ticket` request parameter
 *    and a `subject` request parameter. Use the value returned from
 *    `TokenResponse::getTicket()` method as the value for the `ticket` request
 *    parameter.
 *
 *    The response from `/api/auth/token/issue` API (`TokenIssueResponse`)
 *    contains data (an access token and others) which should be returned to
 *    the client application. Use the data to generate a response to the client
 *    application.
 *
 * 2. When the credentials are invalid, call Authlete's `/api/auth/token/fail`
 *    API with `reason=INVALID_RESOURCE_OWNER_CREDENTIALS` to generate an error
 *    response for the client application. The API requires a `ticket` request
 *    parameter. Use the value returned from `TokenResponse::getTicket()`
 *    method as the value for the `ticket` request parameter.
 *
 *    The response from `/api/auth/token/fail` API (`TokenFailResponse`)
 *    contains error information which should be returned to the client
 *    application. Use it to generate a response to the client application.
 *
 * ---
 *
 * When the value returned from `getAction()` method is `TokenAction::$OK`, it
 * means that the request from the client application is valid, and an access
 * token and optionally an ID token are ready to be issued. The HTTP status of
 * the response returned to the client application must be `200 OK` and the
 * content type must be `application/json`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * contains an access token (and optionally an ID token), so it can be used as
 * the entity body of the response. The following illustrates the response
 * which the token endpoint implementation should generate and return to the
 * client application.
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
class TokenResponse extends ApiResponse
{
    private ?TokenAction $action           = null;  // \Authlete\Dto\TokenAction
    private ?string $responseContent       = null;
    private ?string $username              = null;
    private ?string $password              = null;
    private ?string $ticket                = null;
    private ?string $accessToken           = null;
    private $accessTokenExpiresAt          = null;  // string or (64-bit) integer
    private $accessTokenDuration           = null;  // string or (64-bit) integer
    private ?string $refreshToken          = null;
    private $refreshTokenExpiresAt         = null;  // string or (64-bit) integer
    private $refreshTokenDuration          = null;  // string or (64-bit) integer
    private ?string $idToken               = null;
    private ?GrantType $grantType          = null;  // \Authlete\Types\GrantType
    private $clientId                      = null;  // string or (64-bit) integer
    private ?string $clientIdAlias         = null;
    private bool $clientIdAliasUsed        = false;
    private ?string $subject               = null;
    private ?array $scopes                 = null;  // array of string
    private ?array $properties             = null;  // array of \Authlete\Dto\Property
    private ?string $jwtAccessToken        = null;
    private ?array $resources              = null;  // array of string
    private ?array $accessTokenResources   = null;  // array of string


    /**
     * Get the next action that the token endpoint should take.
     *
     * @return TokenAction
     *     The next action that the token endpoint should take.
     */
    public function getAction(): ?TokenAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the token endpoint should take.
     *
     * @param TokenAction|null $action
     *     The next action that the token endpoint should take.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setAction(TokenAction $action = null): TokenResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content which can be used as the entity body of the
     * response returned to the client application.
     *
     * @return string
     *     The response content.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used as the entity body of the
     * response returned to the client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the value of the "username" request parameter contained in the
     * token request from the client application.
     *
     * @return string
     *     The value of the `username` request parameter.
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }


    /**
     * Set the value of the "username" request parameter contained in the
     * token request from the client application.
     *
     * @param string $username
     *     The value of the `username` request parameter.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setUsername(string $username): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$username', $username);

        $this->username = $username;

        return $this;
    }


    /**
     * Get the value of the "password" request parameter contained in the
     * token request from the client application.
     *
     * @return string
     *     The value of the `password` request parameter.
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }


    /**
     * Set the value of the "password" request parameter contained in the
     * token request from the client application.
     *
     * @param string $password
     *     The value of the `password` request parameter.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setPassword(string $password): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$password', $password);

        $this->password = $password;

        return $this;
    }


    /**
     * Get the ticket issued from Authlete's /api/auth/token API.
     *
     * The value is to be used as the value of the `ticket` rquest parameter
     * when you call `/api/auth/token/issue` API or `/api/auth/token/fail` API.
     *
     * @return string
     *     The ticket issued from Authlete's `/api/auth/token` API.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket issued from Authlete's /api/auth/token API.
     *
     * @param string $ticket
     *     The ticket issued from Authlete's `/api/auth/token` API.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setTicket(string $ticket): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the newly issued access token.
     *
     * This method returns a non-null value only when `getAction()` method
     * returns `TokenAction::$OK`.
     *
     * @return string
     *     The access token.
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }


    /**
     * Set the newly issued access token.
     *
     * @param string $accessToken
     *     The access token.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setAccessToken(string $accessToken): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the date in milliseconds since the Unix epoch (1970-Jan-1) at which
     * the access token will expire.
     *
     * @return integer|string|null
     *     The date at which the access token will expire.
     */
    public function getAccessTokenExpiresAt()
    {
        return $this->accessTokenExpiresAt;
    }


    /**
     * Set the date in milliseconds since the Unix epoch (1970-Jan-1) at which
     * the access token will expire.
     *
     * @param integer|string $expiresAt
     *     The date at which the access token will expire.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setAccessTokenExpiresAt($expiresAt): TokenResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->accessTokenExpiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the duration of the access token in seconds.
     *
     * @return integer|string|null
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
     * @return TokenResponse
     *     `$this` object.
     */
    public function setAccessTokenDuration($duration): TokenResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the newly issued refresh token.
     *
     * This method returns a non-null value only when `getAction()` method
     * returns `TokenAction::$OK` and the service is configured to support
     * the [refresh token flow](https://tools.ietf.org/html/rfc6749#section-6).
     *
     * @return string
     *     The newly issued access token.
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }


    /**
     * Set the newly issued refresh token.
     *
     * @param string $refreshToken
     *     The newly issued access token.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setRefreshToken(string $refreshToken): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$refreshToken', $refreshToken);

        $this->refreshToken = $refreshToken;

        return $this;
    }


    /**
     * Get the date in milliseconds since the Unix epoch (1970-Jan-1) at which
     * the refresh token will expire.
     *
     * @return integer|string|null
     *     The date at which the refresh token will expire.
     */
    public function getRefreshTokenExpiresAt()
    {
        return $this->refreshTokenExpiresAt;
    }


    /**
     * Set the date in milliseconds since the Unix epoch (1970-Jan-1) at which
     * the refresh token will expire.
     *
     * @param integer|string $expiresAt
     *     The date at which the refresh token will expire.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setRefreshTokenExpiresAt($expiresAt): TokenResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->refreshTokenExpiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the duration of the refresh token in seconds.
     *
     * @return integer|string|null
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
     * @return TokenResponse
     *     `$this` object.
     */
    public function setRefreshTokenDuration($duration): TokenResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->refreshTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the newly issued ID token.
     *
     * An [ID token](https://openid.net/specs/openid-connect-core-1_0.html#IDToken)
     * is issued from a token endpoint when the
     * [authorization code follow](https://tools.ietf.org/html/rfc6749#section-4.1)
     * is used and `openid` is included in the scope list.
     *
     * @return string
     *     The newly issued ID token.
     */
    public function getIdToken(): ?string
    {
        return $this->idToken;
    }


    /**
     * Set the newly issued ID token.
     *
     * @param string $idToken
     *     The newly issued ID token.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setIdToken(string $idToken): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$idToken', $idToken);

        $this->idToken = $idToken;

        return $this;
    }


    /**
     * Get the grant type of the token request.
     *
     * @return GrantType
     *     The grant type of the token request.
     */
    public function getGrantType(): ?GrantType
    {
        return $this->grantType;
    }


    /**
     * Set the grant type of the token request.
     *
     * @param GrantType|null $grantType
     *     The grant type of the token request.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setGrantType(GrantType $grantType = null): TokenResponse
    {
        $this->grantType = $grantType;

        return $this;
    }


    /**
     * Get the ID of the client application associated with the access token.
     *
     * @return integer|string|null
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
     * @return TokenResponse
     *     `$this` object.
     */
    public function setClientId($clientId): TokenResponse
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
    public function getClientIdAlias(): ?string
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the client ID alias.
     *
     * @param string $alias
     *     The client ID alias.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setClientIdAlias(string $alias): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias was used when
     * the token request was made.
     *
     * @return boolean
     *     `true` if the client ID alias was used by the token request.
     */
    public function isClientIdAliasUsed(): bool
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether the client ID alias was used when
     * the token request was made.
     *
     * @param boolean $used
     *     `true` to indicate that the client ID alias was used by the token
     *     request.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setClientIdAliasUsed(bool $used): TokenResponse
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user (= resource
     * owner) of the access token.
     *
     * Even if an access token was issued by the call of `/api/auth/token`
     * API, this method returns `null` if the flow of the token request was
     * [Client Credentials flow](https://tools.ietf.org/html/rfc6749#section-4.4)
     * (`grant_type=client_credentials`) because access tokens are not
     * associated with any specific end-user in the flow.
     *
     * @return string
     *     The subject of the end-user (= resource owner) of the access token.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user (= resource
     * owner) of the access token.
     *
     * @param string $subject
     *     The subject of the end-user (= resource owner) of the access token.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setSubject(string $subject): TokenResponse
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
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set the scopes covered by the access token.
     *
     * @param string[] $scopes
     *     The scopes covered by the access token.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): TokenResponse
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
    public function getProperties(): ?array
    {
        return $this->properties;
    }


    /**
     * Set the properties associated with the access token.
     *
     * @param Property[] $properties
     *     The properties associated with the access token.
     *
     * @return TokenResponse
     *     `$this` object.
     */
    public function setProperties(array $properties = null): TokenResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

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
     *
     * @since 1.8
     */
    public function getJwtAccessToken(): ?string
    {
        return $this->jwtAccessToken;
    }


    /**
     * Set the newly issued access token in JWT format.
     *
     * @param string $jwtAccessToken
     *     The newly issued access token in JWT format.
     *
     * @return TokenResponse
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setJwtAccessToken(string $jwtAccessToken): TokenResponse
    {
        ValidationUtility::ensureNullOrString('$jwtAccessToken', $jwtAccessToken);

        $this->jwtAccessToken = $jwtAccessToken;

        return $this;
    }


    /**
     * Get the target resources. This represents the resources specified by
     * the `resource` request parameters in the token request.
     *
     * @return string[]
     *     The target resources.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function getResources(): ?array
    {
        return $this->resources;
    }


    /**
     * Set the target resources. This represents the resources specified by
     * the `resource` request parameters in the token request.
     *
     * @param string[] $resources
     *     The target resources.
     *
     * @return TokenResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function setResources(array $resources = null): TokenResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$resources', $resources);

        $this->resources = $resources;

        return $this;
    }


    /**
     * Get the target resources of the access token.
     *
     * The target resources returned by this method may be the same as or
     * different from the ones returned by `getResources()` method.
     *
     * In some flows, the initial request and the subsequent token request
     * are sent to different endpoints. Example flows are the authorization
     * code flow, the refresh token flow, the CIBA ping mode, the CIBA poll
     * mode and the device flow. In these flows, not only the initial
     * request but also the subsequent token request can include the
     * `resource` request parameters. The purpose of the `resource` request
     * parameters in the token request is to narrow the range of the target
     * resources from the original set of target resources requested by the
     * preceding initial request. If narrowing down is performed, the target
     * resources returned by `getResources()` method and the ones returned
     * by this method are different. This method returns the narrowed set
     * of target resources.
     *
     * @return string[]
     *     The target resources of the access token.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function getAccessTokenResources(): ?array
    {
        return $this->accessTokenResources;
    }


    /**
     * Set the target resources of the access token.
     *
     * See the description of `getAccessTokenResources()` method for details
     * about the target resources of the access token.
     *
     * @param string[] $resources
     *     The target resources of the access token.
     *
     * @return TokenResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function setAccessTokenResources(array $resources = null): TokenResponse
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
    public function copyToArray(array &$array): void
    {
        parent::copyToArray($array);

        $array['action']                = LanguageUtility::toString($this->action);
        $array['responseContent']       = $this->responseContent;
        $array['username']              = $this->username;
        $array['password']              = $this->password;
        $array['ticket']                = $this->ticket;
        $array['accessToken']           = $this->accessToken;
        $array['accessTokenExpiresAt']  = LanguageUtility::orZero($this->accessTokenExpiresAt);
        $array['accessTokenDuration']   = LanguageUtility::orZero($this->accessTokenDuration);
        $array['refreshToken']          = $this->refreshToken;
        $array['refreshTokenExpiresAt'] = LanguageUtility::orZero($this->refreshTokenExpiresAt);
        $array['refreshTokenDuration']  = LanguageUtility::orZero($this->refreshTokenDuration);
        $array['idToken']               = $this->idToken;
        $array['grantType']             = LanguageUtility::toString($this->grantType);
        $array['clientId']              = $this->clientId;
        $array['clientIdAlias']         = $this->clientIdAlias;
        $array['clientIdAliasUsed']     = $this->clientIdAliasUsed;
        $array['subject']               = $this->subject;
        $array['scopes']                = $this->scopes;
        $array['properties']            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['jwtAccessToken']        = $this->jwtAccessToken;
        $array['resources']             = $this->resources;
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
            TokenAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // username
        $this->setUsername(
            LanguageUtility::getFromArray('username', $array));

        // password
        $this->setPassword(
            LanguageUtility::getFromArray('password', $array));

        // ticket
        $this->setTicket(
            LanguageUtility::getFromArray('ticket', $array));

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

        // idToken
        $this->setIdToken(
            LanguageUtility::getFromArray('idToken', $array));

        // grantType
        $this->setGrantType(
            GrantType::valueOf(
                LanguageUtility::getFromArray('grantType', $array)));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // clientIdAlias
        $this->setClientIdAlias(
            LanguageUtility::getFromArray('clientIdAlias', $array));

        // clientIdAliasUsed
        $this->setClientIdAliasUsed(
            LanguageUtility::getFromArrayAsBoolean('clientIdAlias', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);

        // jwtAccessToken
        $this->setJwtAccessToken(
            LanguageUtility::getFromArray('jwtAccessToken', $array));

        // resources
        $_resources = LanguageUtility::getFromArray('resources', $array);
        $this->setResources($_resources);

        // accessTokenResources
        $_access_token_resources = LanguageUtility::getFromArray('accessTokenResources', $array);
        $this->setAccessTokenResources($_access_token_resources);
    }
}

