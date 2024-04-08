<?php
//
// Copyright (C) 2018-2022 Authlete, Inc.
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
 * File containing the definition of IntrospectionResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/introspection API.
 *
 * Authlete's `/api/auth/introspection` API returns JSON which can be mapped
 * to this class. The resource server should retrieve the value of the
 * `action` response parameter from the response and take the following steps
 * according to the value.
 *
 * When the value returned from `getAction()` method is
 * `IntrospectionAction::$INTERNAL_SERVER_ERROR`, it means that the request
 * from the resource server was wrong or that an error occurred in Authlete.
 * In either case, from a viewpoint of the client application, it is an error
 * on the server side. Therefore, the resource server should generate a
 * response to the client application with the HTTP status of
 * `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a string which
 * describes the error in the format of
 * [RFC 6750](https://tools.ietf.org/html/rfc6750) (OAuth 2.0 Bearer Token
 * Usage), so if the protected resource of the resource server wants to
 * return an error response to the client application in the way that
 * complies with RFC 6750, the string returned from `getResponseContent()`
 * method can be used as the value of the `WWW-Authenticate` header. The
 * following is an example response which complies with RFC 6750.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `IntrospectionAction::$BAD_REQUEST`, it means that the request from the
 * client application does not contain an access token (= the request from
 * the resource server to Authlete does not contain the `token` request
 * parameter).
 *
 * In this case, `getResponseContent()` method returns a string which
 * describes the error in the format of
 * [RFC 6750](https://tools.ietf.org/html/rfc6750) (OAuth 2.0 Bearer Token
 * Usage), so if the protected resource of the resource server wants to
 * return an error response to the client application in the way that
 * complies with RFC 6750, the string returned from `getResponseContent()`
 * method can be used as the value of the `WWW-Authenticate` header. The
 * following is an example response which complies with RFC 6750.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `IntrospectionAction::$UNAUTHORIZED`, it means that the access token does
 * not exist or has expired. Or the client application associated with the
 * access token does not exist any longer.
 *
 * In this case, `getResponseContent()` method returns a string which
 * describes the error in the format of
 * [RFC 6750](https://tools.ietf.org/html/rfc6750) (OAuth 2.0 Bearer Token
 * Usage), so if the protected resource of the resource server wants to
 * return an error response to the client application in the way that
 * complies with RFC 6750, the string returned from `getResponseContent()`
 * method can be used as the value of the `WWW-Authenticate` header. The
 * following is an example response which complies with RFC 6750.
 *
 * ```
 * HTTP/1.1 401 Unauthorized
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `IntrospectionAction::$FORBIDDEN`, it means that the access token does
 * not cover the required scopes or that the subject associated with the
 * access token is different from the subject specified by the API call.
 *
 * In this case, `getResponseContent()` method returns a string which
 * describes the error in the format of
 * [RFC 6750](https://tools.ietf.org/html/rfc6750) (OAuth 2.0 Bearer Token
 * Usage), so if the protected resource of the resource server wants to
 * return an error response to the client application in the way that
 * complies with RFC 6750, the string returned from `getResponseContent()`
 * method can be used as the value of the `WWW-Authenticate` header. The
 * following is an example response which complies with RFC 6750.
 *
 * ```
 * HTTP/1.1 403 Forbidden
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `IntrospectionAction::$OK`, it means that the access token which the
 * client application presented is valid (= exists and has not expired).
 * The resource server is supposed to return the proteced resource to the
 * client application.
 *
 * In this case, `getResponseContent()` property returns
 * `Bearer error=\"invalid_request\""`. This is the simplest string which
 * can be used as the value of the `WWW-Authenticate` header to indicate
 * `400 Bad Request`. The resource server may use this string to tell the
 * client application that the request was bad. But in such a case, if
 * possible, the resource server should generate a more informative error
 * message to help developers of client applications. The following is an
 * example error response which complies with RFC 6750.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * Basically, `getResponseContent()` method returns a string which describes
 * the error in the format of
 * [RFC 6750](https://tools.ietf.org/html/rfc6750") (OAuth 2.0 Bearer Token
 * Usage), so if the resource server has selected `Bearer` as the token type,
 * the string returned from `getResponseContent()` method can be used directly
 * as the value for the `WWW-Authenticate` header. However, if the service has
 * selected another different token type, the resource server has to generate
 * error message for itself.
 */
class IntrospectionResponse extends ApiResponse
{
    private ?IntrospectionAction $action   = null;
    private string|int|null $clientId      = null;
    private ?string $subject               = null;
    private ?array $scopes                 = null;  // array of string
    private ?array $scopeDetails           = null;  // array of string
    private bool $existent                 = false;
    private bool $usable                   = false;
    private bool $sufficient               = false;
    private bool $refreshable              = false;
    private ?string $responseContent       = null;
    private string|int|null $expiresAt     = null;
    private ?array $properties             = null;  // array of \Authlete\Dto\Property
    private ?string $clientIdAlias         = null;
    private bool $clientIdAliasUsed        = false;
    private ?string $certificateThumbprint = null;
    private ?array $resources              = null;  // array of string
    private ?array $accessTokenResources   = null;  // array of string
    private ?string $grantId               = null;
    private ?array $consentedClaims        = null;  // array of string
    private ?array $serviceAttributes      = null;  // array of \Authlete\Dto\Pair
    private ?array $clientAttributes       = null;  // array of \Authlete\Dto\Pair
    private bool $forExternalAttachment    = false;


    /**
     * Get the next action that the resource server should take.
     *
     * @return IntrospectionAction|null
     *     The next action that the resource server should take.
     */
    public function getAction(): ?IntrospectionAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the resource server should take.
     *
     * @param IntrospectionAction|null $action
     *     The next action that the resource server should take.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setAction(IntrospectionAction $action = null): IntrospectionResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the client ID of the client application to which the access token
     * has been issued.
     *
     * @return int|string|null
     *     The ID of the client application associated with the access token.
     */
    public function getClientId(): int|string|null
    {
        return $this->clientId;
    }


    /**
     * Set the client ID of the client application to which the access token
     * has been issued.
     *
     * @param integer|string $clientId
     *     The ID of the client application associated with the access token.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setClientId(int|string $clientId): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user (= resource owner)
     * who allowed the authorization server  to issue the access token to the
     * client application.
     *
     * @return string|null
     *     The subject of the end-user associated with the access token.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user (= resource owner)
     * who allowed the authorization server  to issue the access token to the
     * client application.
     *
     * @param string $subject
     *     The subject of the end-user associated with the access token.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setSubject(string $subject): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the scopes that are associated with the access token.
     *
     * @return array|null
     *     The scopes associated with the access token.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set the scopes that are associated with the access token.
     *
     * @param string[] $scopes
     *     The scopes associated with the access token.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the details of the scopes.
     *
     * The scopes property of this class is a list of scope names. The
     * property does not hold information about scope attributes. This
     * `scopeDetails` property was newly created to convey information
     * about scope attributes.
     *
     * @return array|null
     *     The details of the scopes.
     *
     * @since 1.11
     */
    public function getScopeDetails(): ?array
    {
        return $this->scopeDetails;
    }


    /**
     * Set the details of the scopes.
     *
     * The scopes property of this class is a list of scope names. The
     * property does not hold information about scope attributes. This
     * `scopeDetails` property was newly created to convey information
     * about scope attributes.
     *
     * @param Scope[] $scopeDetails
     *     The details of the scopes.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.11
     */
    public function setScopeDetails(array $scopeDetails = null): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$scopeDetails', __NAMESPACE__ . '\Scope', $scopeDetails);

        $this->scopeDetails = $scopeDetails;

        return $this;
    }


    /**
     * Get the flag which indicates whether the access token exists or not.
     *
     * @return boolean
     *     `true` if the access token exists.
     */
    public function isExistent(): bool
    {
        return $this->existent;
    }


    /**
     * Set the flag which indicates whether the access token exists or not.
     *
     * @param boolean $existent
     *     `true` if the access token exists.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setExistent(bool $existent): IntrospectionResponse
    {
        ValidationUtility::ensureBoolean('$existent', $existent);

        $this->existent = $existent;

        return $this;
    }


    /**
     * Get the flag which indicates whether the access token is usable
     * (= exists and has not expired).
     *
     * @return boolean
     *     `true` if the access token is usable (= exists and has not expired).
     */
    public function isUsable(): bool
    {
        return $this->usable;
    }


    /**
     * Set the flag which indicates whether the access token is usable
     * (= exists and has not expired).
     *
     * @param boolean $usable
     *     `true` if the access token is usable (= exists and has not expired).
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setUsable(bool $usable): IntrospectionResponse
    {
        ValidationUtility::ensureBoolean('$usable', $usable);

        $this->usable = $usable;

        return $this;
    }


    /**
     * Get the flag which indicates whether the access token covers the
     * required scopes.
     *
     * @return boolean
     *     `true` if the access token covers the required scopes.
     */
    public function isSufficient(): bool
    {
        return $this->sufficient;
    }


    /**
     * Set the flag which indicates whether the access token covers the
     * required scopes.
     *
     * @param boolean $sufficient
     *     `true` if the access token covers the required scopes.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setSufficient(bool $sufficient): IntrospectionResponse
    {
        ValidationUtility::ensureBoolean('$sufficient', $sufficient);

        $this->sufficient = $sufficient;

        return $this;
    }


    /**
     * Get the flag which indicates whether the access token can be refreshed
     * using the associated refresh token.
     *
     * Even if there exists a refresh token associated with the access token,
     * this property returns `false` if the refresh token has already expired.
     *
     * @return boolean
     *     `true` if the access token can be refreshed using the associated
     *     refresh token.
     */
    public function isRefreshable(): bool
    {
        return $this->refreshable;
    }


    /**
     * Set the flag which indicates whether the access token can be refreshed
     * using the associated refresh token.
     *
     * @param boolean $refreshable
     *     `true` if the access token can be refreshed using the associated
     *     refresh token.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setRefreshable(bool $refreshable): IntrospectionResponse
    {
        ValidationUtility::ensureBoolean('$refreshable', $refreshable);

        $this->refreshable = $refreshable;

        return $this;
    }


    /**
     * Get the response content which can be used as a part of the response
     * to the client application.
     *
     * @return string
     *     The response content.
     */
    public function getResponseContent(): string
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used as a part of the response
     * to the client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the time at which the access token will expire.
     *
     * @return int|string|null
     *     The time at which the access token will expire. The value is
     *     represented as milliseconds since the Unix epoch (1970-Jan-1).
     */
    public function getExpiresAt(): int|string|null
    {
        return $this->expiresAt;
    }


    /**
     * Set the time at which the access token will expire.
     *
     * @param integer|string $expiresAt
     *     The time at which the access token will expire. The value should
     *     be represented as milliseconds since the Unix epoch (1970-Jan-1).
     */
    public function setExpiresAt(int|string $expiresAt): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->expiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the properties associated with the access token.
     *
     * @return Property[]
     *     Properties.
     *
     * @since 1.3
     */
    public function getProperties(): array
    {
        return $this->properties;
    }


    /**
     * Set the properties associated with the access token.
     *
     * @param Property[] $properties
     *     Properties.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setProperties(array $properties = null): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get the client ID alias when the authorization request or the token
     * request for the access token was made.
     *
     * Note that this value may be different from the current client ID alias.
     *
     * @return string
     *     The client ID alias when the authorization request or the token
     *     request for the access token was made.
     *
     * @since 1.3
     */
    public function getClientIdAlias(): string
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the client ID alias when the authorization request or the token
     * request for the access token was made.
     *
     * @param string $alias
     *     The client ID alias.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setClientIdAlias(string $alias): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias was used when
     * the authorization request or the token request for the access token
     * was made.
     *
     * @return boolean
     *     `true` if the client ID alias was used when the authorization
     *     request or the token request for the access token was made.
     *
     * @since 1.3
     */
    public function isClientIdAliasUsed(): bool
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether the client ID alias was used when
     * the authorization request or the token request for the access token
     * was made.
     *
     * @param boolean $used
     *     `true` if the client ID alias was used when the authorization
     *     request or the token request for the access token was made.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setClientIdAliasUsed(bool $used): IntrospectionResponse
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the client certificate thumbprint used to validate the access token.
     *
     * @return string|null
     *     The certificate thumbprint, calculated as the SHA-256 hash of the
     *     DER-encoded certificate value.
     *
     * @since 1.3
     */
    public function getCertificateThumbprint(): ?string
    {
        return $this->certificateThumbprint;
    }


    /**
     * Set the client certificate thumbprint used to validate the access token.
     *
     * @param string $thumbprint
     *     The certificate thumbprint, calculated as the SHA-256 hash of the
     *     DER-encoded certificate value.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.3
     */
    public function setCertificateThumbprint(string $thumbprint): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrString('$thumbprint', $thumbprint);

        $this->certificateThumbprint = $thumbprint;

        return $this;
    }


    /**
     * Get the target resources. This represents the resources specified by
     * the `resource` request parameters or by the `resource` property in
     * the request object.
     *
     * @return array|null
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
     * the `resource` request parameters or by the `resource` property in
     * the request object.
     *
     * @param string[] $resources
     *     The target resources.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function setResources(array $resources = null): IntrospectionResponse
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
     * @return array|null
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
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function setAccessTokenResources(array $resources = null): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$resources', $resources);

        $this->accessTokenResources = $resources;

        return $this;
    }


    /**
     * Get the grant ID which the access token is tied to.
     *
     * In Authlete, when an authorization request includes the `grant_management_action`
     * request parameter, a grant ID (which may be a newly-generated one or an existing
     * one specified by the `grant_id` request parameter) is tied to the access token
     * which is created as a result of the authorization request.
     *
     * @return string|null
     *     The grant ID tied to the access token.
     *
     * @since 1.11
     */
    public function getGrantId(): ?string
    {
        return $this->grantId;
    }


    /**
     * Set the grant ID which the access token is tied to.
     *
     * In Authlete, when an authorization request includes the `grant_management_action`
     * request parameter, a grant ID (which may be a newly-generated one or an existing
     * one specified by the `grant_id` request parameter) is tied to the access token
     * which is created as a result of the authorization request.
     *
     * @param string $grantId
     *     The grant ID tied to the access token.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.11
     */
    public function setGrantId(string $grantId): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrString('$grantId', $grantId);

        $this->grantId = $grantId;

        return $this;
    }


    /**
     * Get the claims that the user has consented for the client application
     * to know.
     *
     * Some Authlete APIs accept a `consentedClaims` request parameter (which
     * is available from Authlete 2.3). This `consentedClaims` property holds
     * the value specified by the request parameter.
     *
     * @return array|null The consented claims.
     *     The consented claims.
     *
     * @since 1.11
     */
    public function getConsentedClaims(): ?array
    {
        return $this->consentedClaims;
    }


    /**
     * Set the claims that the user has consented for the client application
     * to know.
     *
     * Some Authlete APIs accept a `consentedClaims` request parameter (which
     * is available from Authlete 2.3). This `consentedClaims` property holds
     * the value specified by the request parameter.
     *
     * @param string[] $claims
     *     The consented claims.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.11
     */
    public function setConsentedClaims(array $claims = null): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$claims', $claims);

        $this->consentedClaims = $claims;

        return $this;
    }


    /**
     * Get the attributes of the service that the client application belongs to.
     *
     * @return array|null The attributes of the service.
     *     The attributes of the service.
     *
     * @since 1.11
     */
    public function getServiceAttributes(): ?array
    {
        return $this->serviceAttributes;
    }


    /**
     * Set the attributes of the service that the client application belongs to.
     *
     * @param Pair[] $attributes
     *     The attributes of the service.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.11
     */
    public function setServiceAttributes(array $attributes = null): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$attributes', __NAMESPACE__ . '\Pair', $attributes);

        $this->serviceAttributes = $attributes;

        return $this;
    }


    /**
     * Get the attributes of the client that the access token has been issued to.
     *
     * @return array|null
     *     The attributes of the client.
     *
     * @since 1.11
     */
    public function getClientAttributes(): ?array
    {
        return $this->clientAttributes;
    }


    /**
     * Set the attributes of the client that the access token has been issued to.
     *
     * @param Pair[] $attributes
     *     The attributes of the client.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.11
     */
    public function setClientAttributes(array $attributes = null): IntrospectionResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$attributes', __NAMESPACE__ . '\Pair', $attributes);

        $this->clientAttributes = $attributes;

        return $this;
    }


    /**
     * Get the flag which indicates whether the access token is for an external
     * attachment.
     *
     * OpenID Provider implementations can make Authlete generate access tokens
     * for external attachments and embed them in ID tokens and userinfo responses
     * by setting `true` to the `accessTokenForExternalAttachmentEmbedded` property
     * of the service. If the token presented at Authlete's `/auth/introspection`
     * API has been generated by the feature, this `forExternalAttachment` property
     * in the response from the Authlete API becomes `true`.
     *
     * @return boolean
     *     `true` if the access token is for an external attachment.
     *
     * @since 1.11
     */
    public function isForExternalAttachment(): bool
    {
        return $this->forExternalAttachment;
    }


    /**
     * Set the flag which indicates whether the access token is for an external
     * attachment.
     *
     * OpenID Provider implementations can make Authlete generate access tokens
     * for external attachments and embed them in ID tokens and userinfo responses
     * by setting `true` to the `accessTokenForExternalAttachmentEmbedded` property
     * of the service. If the token presented at Authlete's `/auth/introspection`
     * API has been generated by the feature, this `forExternalAttachment` property
     * in the response from the Authlete API becomes `true`.
     *
     * @param boolean $forExternalAttachment
     *     `true` to indicate that the access token is for an external attachment.
     *
     * @return IntrospectionResponse
     *     `$this` object.
     *
     * @since 1.11
     */
    public function setForExternalAttachment(bool $forExternalAttachment): IntrospectionResponse
    {
        ValidationUtility::ensureBoolean('$forExternalAttachment', $forExternalAttachment);

        $this->forExternalAttachment = $forExternalAttachment;

        return $this;
    }


    /**
     * Get the flag which indicates whether the access token is active
     * (= exists and has not expired).
     *
     * This method is just an alias of `isUsable()` method. The reason this
     * method was added is to mitigate confusion that those who are familiar
     * with [RFC 7662](https://tools.ietf.org/html/rfc7662) (OAuth 2.0 Token
     * Introspection) may have.
     *
     * @return boolean
     *     `true` if the access token is active (= exists and has not expired).
     */
    public function isActive(): bool
    {
        return $this->isUsable();
    }


    /**
     * Set the flag which indicates whether the access token is active
     * (= exists and has not expired).
     *
     * This method is just an alias of `setUsable($usable)` method. The reason
     * this method was added is to mitigate confusion that those who are
     * familiar with [RFC 7662](https://tools.ietf.org/html/rfc7662) (OAuth 2.0
     * Token Introspection) may have.
     *
     * @param boolean $active
     *     `true` if the access token is active (= exists and has not expired).
     *
     * @return IntrospectionResponse
     *     `$this` object.
     */
    public function setActive(bool $active): IntrospectionResponse
    {
        ValidationUtility::ensureBoolean('$active', $active);

        return $this->setUsable($active);
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
        $array['clientId']              = $this->clientId;
        $array['subject']               = $this->subject;
        $array['scopes']                = $this->scopes;
        $array['scopeDetails']          = LanguageUtility::convertArrayOfArrayCopyableToArray($this->scopeDetails);
        $array['existent']              = $this->existent;
        $array['usable']                = $this->usable;
        $array['sufficient']            = $this->sufficient;
        $array['refreshable']           = $this->refreshable;
        $array['responseContent']       = $this->responseContent;
        $array['expiresAt']             = $this->expiresAt;
        $array['properties']            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['clientIdAlias']         = $this->clientIdAlias;
        $array['clientIdAliasUsed']     = $this->clientIdAliasUsed;
        $array['certificateThumbprint'] = $this->certificateThumbprint;
        $array['resources']             = $this->resources;
        $array['accessTokenResources']  = $this->accessTokenResources;
        $array['grantId']               = $this->grantId;
        $array['consentedClaims']       = $this->consentedClaims;
        $array['serviceAttributes']     = LanguageUtility::convertArrayOfArrayCopyableToArray($this->serviceAttributes);
        $array['clientAttributes']      = LanguageUtility::convertArrayOfArrayCopyableToArray($this->clientAttributes);
        $array['forExternalAttachment'] = $this->forExternalAttachment;
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
            IntrospectionAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // scopeDetails
        $_scopeDetails = LanguageUtility::getFromArray('scopeDetails', $array);
        $_scopeDetails = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Scope', $_scopeDetails);
        $this->setScopeDetails($_scopeDetails);

        // existent
        $this->setExistent(
            LanguageUtility::getFromArrayAsBoolean('existent', $array));

        // usable
        $this->setUsable(
            LanguageUtility::getFromArrayAsBoolean('usable', $array));

        // sufficient
        $this->setSufficient(
            LanguageUtility::getFromArrayAsBoolean('sufficient', $array));

        // refreshable
        $this->setRefreshable(
            LanguageUtility::getFromArrayAsBoolean('refreshable', $array));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // expiresAt
        $this->setExpiresAt(
            LanguageUtility::getFromArray('expiresAt', $array));

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);

        // clientIdAlias
        $this->setClientIdAlias(
            LanguageUtility::getFromArray('clientIdAlias', $array));

        // clientIdAliasUsed
        $this->setClientIdAliasUsed(
            LanguageUtility::getFromArrayAsBoolean('clientIdAliasUsed', $array));

        // certificateThumbprint
        $this->setCertificateThumbprint(
            LanguageUtility::getFromArray('certificateThumbprint', $array));

        // resources
        $_resources = LanguageUtility::getFromArray('resources', $array);
        $this->setResources($_resources);

        // accessTokenResources
        $_access_token_resources = LanguageUtility::getFromArray('accessTokenResources', $array);
        $this->setAccessTokenResources($_access_token_resources);

        // grantId
        $this->setGrantId(
            LanguageUtility::getFromArray('grantId', $array));

        // consentedClaims
        $_consentedClaims = LanguageUtility::getFromArray('consentedClaims', $array);
        $this->setConsentedClaims($_consentedClaims);

        // serviceAttributes
        $_serviceAttributes = LanguageUtility::getFromArray('serviceAttributes', $array);
        $_serviceAttributes = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Pair', $_serviceAttributes);
        $this->setServiceAttributes($_serviceAttributes);

        // clientAttributes
        $_clientAttributes = LanguageUtility::getFromArray('clientAttributes', $array);
        $_clientAttributes = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Pair', $_clientAttributes);
        $this->setClientAttributes($_clientAttributes);

        // forExternalAttachment
        $this->setForExternalAttachment(
            LanguageUtility::getFromArrayAsBoolean('forExternalAttachment', $array));
    }
}
