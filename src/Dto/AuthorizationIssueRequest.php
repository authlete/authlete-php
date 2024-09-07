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


    private $ticket              = null;  // string
    private $subject             = null;  // string
    private $sub                 = null;  // string
    private $authTime            = null;  // string or (64-bit) integer
    private $acr                 = null;  // string
    private $claims              = null;  // string
    private $properties          = null;  // array of \Authlete\Dto\Property
    private $scopes              = null;  // array of string
    private $idtHeaderParams     = null;  // string
    private $consentedClaims     = null;  // array of string
    private $jwtAtClaims         = null;  // string
    private $accessToken         = null;  // string
    private $idTokenAudType      = null;  // string
    private $accessTokenDuration = null;  // string or (64-bit) integer


    /**
     * Get the ticket issued by Authlete's /api/auth/authorization API.
     *
     * @return string
     *     The ticket issued by Authlete's /api/auth/authorization API.
     */
    public function getTicket()
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
    public function setTicket($ticket)
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * @return string
     *     The unique identifier of an end-user.
     */
    public function getSubject()
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
    public function setSubject($subject)
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the value of the "sub" claim used in the ID token which is to
     * be issued.
     *
     * @return string
     *     The value of the `sub` claim used in the ID token.
     */
    public function getSub()
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
    public function setSub($sub)
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
     * @return integer|string
     *     The time when the authentication of the end-user occurred.
     */
    public function getAuthTime()
    {
        return $this->authTime;
    }


    /**
     * Set the time when the authentication of the end-user occurred.
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
    public function setAuthTime($authTime)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$authTime', $authTime);

        $this->authTime = $authTime;

        return $this;
    }


    /**
     * Get the Authentication Context Class Reference performed for the
     * end-user authentication.
     *
     * @return string
     *     The Authentication Context Class Reference.
     */
    public function getAcr()
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
    public function setAcr($acr)
    {
        ValidationUtility::ensureNullOrString('$acr', $acr);

        $this->acr = $acr;

        return $this;
    }


    /**
     * Get the claims of the end-user (= pieces of information about the
     * end-user) in JSON format.
     *
     * @return string
     *     The claims of the end-user in JSON format.
     */
    public function getClaims()
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
    public function setClaims($claims)
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the properties which are associated with an access token and/or
     * an authorization code which will be issued.
     *
     * @return Property[]
     *     Extra properties.
     */
    public function getProperties()
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
     * @param array $properties
     *     An array of \Authlete\Dto\Property.
     *
     * @return AuthorizationIssueRequest
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
     * Get scopes that should be associated with an authorization code
     * and/or an access token.
     *
     * @return string[]
     *     A string array that represents scope names.
     */
    public function getScopes()
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
     * @param array $scopes
     *     A string array that represents scope names.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get JSON that represents additional JWS header parameters for ID tokens
     * that may be issued based on the authorization request.
     *
     * @return string
     *     JSON that represents additional JWS header parameters for ID tokens.
     *
     * @since 1.8
     */
    public function getIdtHeaderParams()
    {
        return $this->idtHeaderParams;
    }


    /**
     * Set JSON that represents additional JWS header parameters for ID tokens
     * that may be issued based on the authorization request.
     *
     * @param string $params
     *     JSON that represents additional JWS header parameters for ID tokens.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setIdtHeaderParams($params)
    {
        ValidationUtility::ensureNullOrString('$params', $params);

        $this->idtHeaderParams = $params;

        return $this;
    }


    /**
     * Get the claims that the user has consented for the client application
     * to know.
     *
     * @return string[]
     *     A string array that represents consented claims.
     *
     * @since 1.13.0
     */
    public function getConsentedClaims()
    {
        return $this->consentedClaims;
    }


    /**
     * Set the claims that the user has consented for the client application
     * to know.
     *
     * If the `claims` request parameter holds JSON, Authlete extracts claims
     * from the JSON and embeds them in an ID token. However, the claims are
     * not necessarily identical to the set of claims that the user has
     * actually consented for the client application to know.
     *
     * For example, if the user has allowed the `profile` scope to be tied to
     * an access token being issued, it technically means that the user has
     * consented for the client application to know the following claims based
     * on the mapping defined in OpenID Connect Core 1.0, Section 5.4.
     * Requesting Claims using Scope Values: `name`, `family_name`, `given_name`,
     * `middle_name`, `nickname`, `preferred_username`, `profile`, `picture`,
     * `website`, `gender`, `birthdate`, `zoneinfo`, `locale` and `updated_at`.
     * However, JSON of the `claims` request parameter does not necessarily
     * include all the claims. It may be simply because the authorization server
     * does not support other claims or because the authorization server intends
     * to return requested claims from the userinfo endpoint instead of embedding
     * them in an ID token, or for some other reasons. Therefore, Authlete does
     * not assume that the claims in the JSON of the `claims` request parameter
     * represent the complete set of consented claims.
     *
     * This `consentedClaims` request parameter (available since Authlete 2.3)
     * can be used to convey the exact set of consented claims to Authlete.
     * Authlete saves the information into its database and makes them
     * referrable in responses from the `/auth/introspection` API and the
     * `/auth/userinfo` API.
     *
     * In addition, the information conveyed via this `consentedClaims` request
     * parameter is used to compute the exact value of the `claims` parameter
     * in responses from the grant management endpoint, which is defined in
     * Grant Management for OAuth 2.0.
     *
     * When this request parameter is missing or its value is empty, Authlete
     * computes the set of consented claims from the consented scopes (e.g.
     * `profile`) and the claims in the JSON of the `claims` request parameter
     * although Authlete knows the possibility that the computed set may be
     * different from the actual set of consented claims. Especially, the
     * computed set may not include claims that the authorization server
     * returns from the userinfo endpoint. Therefore, if you want to control
     * the exact set of consented claims, utilize this request parameter.
     *
     * @param array $claims
     *     A string array that represents consented claims.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     *
     * @since 1.13.0
     */
    public function setConsentedClaims(array $claims = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$claims', $claims);

        $this->consentedClaims = $claims;

        return $this;
    }


    /**
     * Get the additional claims in JSON object format that are added to the
     * payload part of the JWT access token.
     *
     * This request parameter has a meaning only when the format of access
     * tokens issued by this service is JWT. In other words, it has a meaning
     * only when the `accessTokenSignAlg` property of the `Service` holds a
     * non-null value.
     *
     * @return string
     *     Additional claims that are added to the payload part of the JWT
     *     access token.
     *
     * @since 1.13.0
     */
    public function getJwtAtClaims()
    {
        return $this->jwtAtClaims;
    }


    /**
     * Set the additional claims in JSON object format that are added to the
     * payload part of the JWT access token.
     *
     * This request parameter has a meaning only when the format of access
     * tokens issued by this service is JWT. In other words, it has a meaning
     * only when the `accessTokenSignAlg` property of the `Service` holds a
     * non-null value.
     *
     * @param string $claims
     *     Additional claims that are added to the payload part of the JWT
     *     access token.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     *
     * @since 1.13.0
     */
    public function setJwtAtClaims($claims)
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->jwtAtClaims = $claims;

        return $this;
    }


    /**
     * Get the representation of an access token that may be issued as a
     * result of the Authlete API call.
     *
     * Basically, it is the Authlete server's role to generate an access token.
     * However, some systems may have inflexible restrictions on the format of
     * access tokens. Such systems may use this `accessToken` request parameter
     * to specify the representation of an access token by themselves instead
     * of leaving the access token generation task to the Authlete server.
     *
     * Usually, the Authlete server (1) generates a random 256-bit value, (2)
     * base64url-encodes the value into a 43-character string, and (3) uses
     * the resultant string as the representation of an access token. The
     * Authlete implementation is written on the assumption that the 256-bit
     * entropy is big enough. Therefore, make sure that the entropy of the
     * value of the `accessToken` request parameter is big enough, too.
     *
     * The entropy does not necessarily have to be equal to or greater than
     * 256 bits. For example, 192-bit random values (which will become
     * 32-character strings when encoded by base64url) may be enough.
     * However, note that if the entropy is too low, access token string
     * values will collide and Authlete API calls will fail.
     *
     * When no access token is generated as a result of the Authlete API call,
     * this `accessToken` request parameter is not used. Note that the Authlete
     * API generates an access token only when the `response_type` request
     * parameter of the authorization request contains `token`. In other cases,
     * the Authlete API generates no access token.
     *
     * @return string
     *     The representation of an access token that may be issued as a result
     *     of the Authlete API call.
     *
     * @since 1.13.0
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the representation of an access token that may be issued as a
     * result of the Authlete API call.
     *
     * Basically, it is the Authlete server's role to generate an access token.
     * However, some systems may have inflexible restrictions on the format of
     * access tokens. Such systems may use this `accessToken` request parameter
     * to specify the representation of an access token by themselves instead
     * of leaving the access token generation task to the Authlete server.
     *
     * Usually, the Authlete server (1) generates a random 256-bit value, (2)
     * base64url-encodes the value into a 43-character string, and (3) uses
     * the resultant string as the representation of an access token. The
     * Authlete implementation is written on the assumption that the 256-bit
     * entropy is big enough. Therefore, make sure that the entropy of the
     * value of the `accessToken` request parameter is big enough, too.
     *
     * The entropy does not necessarily have to be equal to or greater than
     * 256 bits. For example, 192-bit random values (which will become
     * 32-character strings when encoded by base64url) may be enough.
     * However, note that if the entropy is too low, access token string
     * values will collide and Authlete API calls will fail.
     *
     * When no access token is generated as a result of the Authlete API call,
     * this `accessToken` request parameter is not used. Note that the Authlete
     * API generates an access token only when the `response_type` request
     * parameter of the authorization request contains `token`. In other cases,
     * the Authlete API generates no access token.
     *
     * @param string $accessToken
     *     The representation of an access token that may be issued as a result
     *     of the Authlete API call.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     *
     * @since 1.13.0
     */
    public function setAccessToken($accessToken)
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the type of the `aud` claim of the ID token being issued. Valid
     * values are as follows.
     *
     * `'array'`: The type of the `aud` claim is always an array of strings.
     *
     * `'string'`: The type of the `aud` claim is always a single string.
     *
     * null: The type of the `aud` claim remains the same as before.
     *
     * This request parameter takes precedence over the `idTokenAudType`
     * property of `Service`.
     *
     * @return string
     *     The type of the `aud` claim in ID tokens.
     *
     * @since 1.13.0
     */
    public function getIdTokenAudType()
    {
        return $this->idTokenAudType;
    }


    /**
     * Set the type of the `aud` claim of the ID token being issued. Valid
     * values are as follows.
     *
     * `'array'`: The type of the `aud` claim is always an array of strings.
     *
     * `'string'`: The type of the `aud` claim is always a single string.
     *
     * null: The type of the `aud` claim remains the same as before.
     *
     * This request parameter takes precedence over the `idTokenAudType`
     * property of `Service`.
     *
     * @param string $type
     *     The type of the `aud` claim in ID tokens.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     *
     * @since 1.13.0
     */
    public function setIdTokenAudType($type)
    {
        ValidationUtility::ensureNullOrString('$type', $type);

        $this->idTokenAudType = $type;

        return $this;
    }


    /**
     * Get the duration of the access token that may be issued as a result of
     * the Authlete API call.
     *
     * When this request parameter holds a positive integer, it is used as the
     * duration of the access token. In other cases, this request parameter is
     * ignored.
     *
     * @return integer|string
     *     The duration of the access token in seconds.
     *
     * @since 1.13.0
     */
    public function getAccessTokenDuration()
    {
        return $this->accessTokenDuration;
    }


    /**
     * Set the duration of the access token that may be issued as a result of
     * the Authlete API call.
     *
     * When this request parameter holds a positive integer, it is used as the
     * duration of the access token. In other cases, this request parameter is
     * ignored.
     *
     * @param integer|string $duration
     *     The duration of the access token in seconds.
     *
     * @return AuthorizationIssueRequest
     *     `$this` object.
     *
     * @since 1.13.0
     */
    public function setAccessTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

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
        $array['ticket']              = $this->ticket;
        $array['subject']             = $this->subject;
        $array['sub']                 = $this->sub;
        $array['authTime']            = LanguageUtility::orZero($this->authTime);
        $array['acr']                 = $this->acr;
        $array['claims']              = $this->claims;
        $array['properties']          = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['scopes']              = $this->scopes;
        $array['idtHeaderParams']     = $this->idtHeaderParams;
        $array['consentedClaims']     = $this->consentedClaims;
        $array['jwtAtClaims']         = $this->jwtAtClaims;
        $array['accessToken']         = $this->accessToken;
        $array['idTokenAudType']      = $this->idTokenAudType;
        $array['accessTokenDuration'] = LanguageUtility::orZero($this->accessTokenDuration);
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
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable($_properties, __NAMESPACE__ . '\Property');
        $this->setProperties($_properties);

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

         // idtHeaderParams
        $this->setIdtHeaderParams(
            LanguageUtility::getFromArray('idtHeaderParams', $array));

        // consentedClaims
        $this->setConsentedClaims(
            LanguageUtility:getFromArray('consentedClaims', $array));

        // jwtAtClaims
        $this->setJwtAtClaims(
            LanguageUtility::getFromArray('jwtAtClaims', $array));

        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // idTokenAudType
        $this->setIdTokenAudType(
            LanguageUtility::getFromArray('idTokenAudType', $array));

        // accessTokenDuration
        $this->setAccessTokenDuration(
            LanguageUtility::getFromArray('accessTokenDuration', $array));
    }
}
?>
