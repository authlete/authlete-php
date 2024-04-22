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
 * File containing the definition of AuthorizationIssueRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/auth/authorization/issue API.
 */
class AuthorizationIssueRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $ticket          = null;
    private ?string $subject         = null;
    private ?string $sub             = null;
    private string|int|null $authTime= null;
    private ?string $acr             = null;
    private ?string $claims          = null;
    private ?array $properties       = null;  // array of \Authlete\Dto\Property
    private ?array $scopes           = null;  // array of string
    private ?string $idtHeaderParams = null;


    /**
     * Get the ticket issued by Authlete's /api/auth/authorization API.
     *
     * @return string|null
     *     The ticket issued by Authlete's /api/auth/authorization API.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket issued by Authlete's /api/auth/authorization API.
     * This request parameter is mandatory.
     *
     * @param string $ticket
     *     The ticket issued by Authlete's /api/auth/authorization API.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setTicket(mixed $ticket): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * @return string|null
     *     The unique identifier of an end-user.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * This request parameter is required unless the authorization request
     * has come with `response_type=none` (which means the client application
     * did not request any token to be returned). See
     * [4. None Response Type](https://openid.net/specs/oauth-v2-multiple-response-types-1_0.html#none)
     * in [OAuth 2.0 Multiple Response Type Encoding Practices](https://openid.net/specs/oauth-v2-multiple-response-types-1_0.html)
     * for details about `response_type=none`.
     *
     * The given value is used as the value of the subject associated with
     * the access token (if one is issued) and as the value of the `sub`
     * claim in the ID token (if one is issued).
     *
     * Note that, if `getSub()` method returns a non-empty value, it is used
     * as the value of the `sub` claim in the ID token. However, even in
     * such a case, the value of the subject associated with the access
     * token is still the value which is passed to this method.
     *
     * @param string $subject
     *     The unique identifier of an end-user.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setSubject(mixed $subject): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the value of the "sub" claim used in the ID token which is to
     * be issued.
     *
     * @return string|null
     *     The value of the `sub` claim used in the ID token.
     */
    public function getSub(): ?string
    {
        return $this->sub;
    }


    /**
     * Get the value of the "sub" claim used in the ID token which is to
     * be issued. This request parameter is optional.
     *
     * If a non-empty value is set, it is used as the value of the `sub`
     * claim. Otherwise, the value returned from `getSubject()` method
     * is used. The main purpose of this `setSub()` method is to hide
     * the actual value of the subject from client applications.
     *
     * @param string $sub
     *     The value of the `sub` claim used in the ID token.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setSub(mixed $sub): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrString('$sub', $sub);

        $this->sub = $sub;

        return $this;
    }


    /**
     * Get the time when the authentication of the end-user occurred.
     *
     * The value represents the elapsed time since the Unix epoch
     * (1970-Jan-1) in seconds.
     *
     * @return int|string|null
     *     The time when the authentication of the end-user occurred.
     */
    public function getAuthTime(): int|string|null
    {
        return $this->authTime;
    }


    /**
     * Get the time when the authentication of the end-user occurred.
     *
     * The value should represent the elapsed time since the Unix epoch
     * (1970-Jan-1) in seconds.
     *
     * @param integer|string $authTime
     *     The time when the authentication of the end-user occurred.
     *     The value should represent the elapsed time since the Unix
     *     epoch (1970-Jan-1) in seconds.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setAuthTime(mixed $authTime): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrStringOrInteger('$authTime', $authTime);

        $this->authTime = $authTime;

        return $this;
    }


    /**
     * Get the Authentication Context Class Reference performed for the
     * end-user authentication.
     *
     * @return string|null
     *     The Authentication Context Class Reference.
     */
    public function getAcr(): ?string
    {
        return $this->acr;
    }


    /**
     * Set the Authentication Context Class Reference performed for the
     * end-user authentication.
     *
     * @param string $acr
     *     The Authentication Context Class Reference.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setAcr(mixed $acr): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrString('$acr', $acr);

        $this->acr = $acr;

        return $this;
    }


    /**
     * Get the claims of the end-user (= pieces of information about the
     * end-user) in JSON format.
     *
     * @return string|null
     *     The claims of the end-user in JSON format.
     */
    public function getClaims(): ?string
    {
        return $this->claims;
    }


    /**
     * Set the claims of the end-user (= pieces of information about the
     * end-user) in JSON format. This request parameter is optional.
     *
     * The authorization server implementation is required to retrieve
     * claims of the subject (= information about the end-user) from its
     * database and format them in JSON format.
     *
     * For example, if `given_name` claim, `family_name` claim and `email`
     * claim are required, the authorization server implementation should
     * generate a JSON object like the following and pass its string
     * representation to this method.
     *
     * ```
     * {
     *   "given_name": "Takahiko",
     *   "family_name": "Kawasaki",
     *   "email": "takahiko.kawasaki@example.com"
     * }
     * ```
     *
     * See [5.1. Standard Claims](https://openid.net/specs/openid-connect-core-1_0.html#StandardClaims)
     * in [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
     * for details about the format.
     *
     * @param string $claims
     *     The claims of the end-user in JSON format.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setClaims(mixed $claims): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the properties which are associated with an access token and/or
     * an authorization code which will be issued.
     *
     * @return array|null
     *     Extra properties.
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }


    /**
     * Set the properties which are associated with an access token and/or
     * an authorization code which will be issued. This request parameter
     * is optional.
     *
     * Properties will be returned to the client application together with
     * an access token unless they are marked as hidden. For example, if
     * you set one property as follows:
     *
     * ```
     * $properties = array(
     *     new Property('example_parameter', 'example_value')
     * );
     *
     * $request->setProperties($properties);
     * ```
     *
     * The property will be contained in the final response from the
     * authorization server as follows:
     *
     * ```
     * HTTP/1.1 200 OK
     * Content-Type: application/json;charset=UTF-8
     * Cache-Control: no-store
     * Pragma: no-cache
     *
     * {
     *   "access_token":"2YotnFZFEjr1zCsicMWpAA",
     *   "token_type":"example",
     *   "expires_in":3600,
     *   "refresh_token":"tGzv3JOkF0XG5Qx2TlKWIA",
     *   "example_parameter":"example_value"
     * }
     * ```
     *
     * The above example is an excerpted from
     * [5.1. Successful Response](https://tools.ietf.org/html/rfc6749#section-5.1)
     * in [RFC 6749](https://tools.ietf.org/html/rfc6749).
     *
     * Keys listed below should not be used and they would be ignored on
     * Authlete side even if they were used. It's because they are reserved
     * in [RFC 6749](https://tools.ietf.org/html/rfc6749) and
     * [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * * `access_token`
     * * `token_type`
     * * `expires_in`
     * * `refresh_token`
     * * `scope`
     * * `error`
     * * `error_description`
     * * `error_uri`
     * * `id_token`
     *
     * Note that there is an upper limit on the total size of properties.
     * On Authlete side, the properties will be (1) converted to a
     * multidimensional string array, (2) converted to JSON, (3) encrypted
     * by AES/CBC/PKCS5Padding, (4) encoded by base64url, and then stored
     * into the database. The length of the resultant string must not
     * exceed 65,535 in bytes. This is the upper limit, but we think it is
     * big enough.
     *
     * You can know properties associated with an access token by calling
     * Authlete's `/api/auth/introspection` API.
     *
     * @param array|null $properties
     *     An array of \Authlete\Dto\Property.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setProperties(?array $properties = null): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get scopes that should be associated with an authorization code
     * and/or an access token.
     *
     * @return array|null
     *     A string array that represents scope names.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set scopes that should be associated with an authorization code
     * and/or an access token.
     *
     * If `null` (the default value) is set, the scopes specified in the
     * original authorization request from the client application are
     * used. In other cases, the scopes set by this method will replace
     * the original scopes contained in the original request. This
     * request parameter is optional.
     *
     * Even scopes that are not included in the original authorization
     * request can be specified. However, as an exception, `openid`
     * scope is ignored on Authlete side if it is not included in the
     * original request (to be exact, if `openid` was not included in
     * the `parameters` request parameter of the request to
     * `/api/auth/authorization` API). It is because the existence of
     * the `openid` scope considerably changes the validation steps
     * and because adding `openid` triggers generation of an ID token
     * (although the client application has not requested it) and the
     * behavior is a major violation against the specification.
     *
     * If you add the `offline_access` scope although it is not included
     * in the original request, keep in mind that the specification
     * requires explicit consent from the end-user for the scope
     * ([11. Offline Access](https://openid.net/specs/openid-connect-core-1_0.html#OfflineAccess)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)).
     * When `offline_access` is included in the original authorization
     * request, the current implementation of Authlete's
     * `/api/auth/authorization` API checks whether the authorization
     * request has come along with the `prompt` request parameter and
     * its value includes `consent`. However, note that the
     * implementation of Authlete's `/api/auth/authorization/issue` API
     * does not perform the same validation even if the `offline_access`
     * scope is newly added via this method.
     *
     * @param array|null $scopes
     *     A string array that represents scope names.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get JSON that represents additional JWS header parameters for ID tokens
     * that may be issued based on the authorization request.
     *
     * @return string|null
     *     JSON that represents additional JWS header parameters for ID tokens.
     *
     * @since 1.8
     */
    public function getIdtHeaderParams(): ?string
    {
        return $this->idtHeaderParams;
    }


    /**
     * Set JSON that represents additional JWS header parameters for ID tokens
     * that may be issued based on the authorization request.
     *
     * @param string|null $params
     *     JSON that represents additional JWS header parameters for ID tokens.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setIdtHeaderParams(?string $params): AuthorizationIssueRequest
    {
        ValidationUtility::ensureNullOrString('$idtHeaderParams', $params);

        $this->idtHeaderParams = $params;

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
        $array['ticket']          = $this->ticket;
        $array['subject']         = $this->subject;
        $array['sub']             = $this->sub;
        $array['authTime']        = LanguageUtility::orZero($this->authTime);
        $array['acr']             = $this->acr;
        $array['claims']          = $this->claims;
        $array['properties']      = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['scopes']          = $this->scopes;
        $array['idtHeaderParams'] = $this->idtHeaderParams;
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
        // ticket
        $this->setTicket(
            LanguageUtility::getFromArray('ticket', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // sub
        $this->setSub(
            LanguageUtility::getFromArray('sub', $array));

        // authTime
        $this->setAuthTime(
            LanguageUtility::getFromArray('authTime', $array));

        // acr
        $this->setAcr(
            LanguageUtility::getFromArray('acr', $array));

        // claims
        $this->setClaims(
            LanguageUtility::getFromArray('claims', $array));

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

         // idtHeaderParams
        $this->setIdtHeaderParams(
            LanguageUtility::getFromArray('idtHeaderParams', $array));
    }
}

