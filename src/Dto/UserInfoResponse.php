<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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
 * File containing the definition of UserInfoResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/userinfo API.
 *
 * Authlete's `/api/auth/userinfo` API returns JSON which can be mapped to
 * this class. The [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
 * implementation should retrieve the value of the `action` response parameter
 * (which can be obtained by `getAction()` method of this class) and take the
 * following steps according to the value.
 *
 * When the value returned from `getAction()` method is
 * `UserInfoAction::$INTERNAL_SERVER_ERROR`, it means that the request from
 * your system was wrong or that an error occurred in Authlete. In either
 * case, from a viewpoint of the client application, it is an error on the
 * server side. Therefore, the userinfo endpoint implementation should
 * generate a response to the client application with the HTTP status of
 * `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation can
 * use the string returned from the method as the value of the
 * `WWW-Authenticate` header.
 *
 * The following is an example response which complies with RFC 6750. Note that
 * OpenID Connect Core 1.0 requires that an error response from the userinfo
 * endpoint comply with RFC 6750. See
 * [5.3.3. UserInfo Error Response](https://openid.net/specs/openid-connect-core-1_0.html#UserInfoError)
 * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
 * for details.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoAction::$BAD_REQUEST`, it means that the request from the client
 * application does not contain an access token (= the request from your system
 * to Authlete does not contain the `token` request parameter).
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation can
 * use the string returned from the method as the value of the
 * `WWW-Authenticate` header. The following is an example response from the
 * userinfo endpoint to the client application.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoAction::$UNAUTHORIZED`, it means that the access token does not
 * exist, has expired, or is not associated with any subject (= any end-user).
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation can
 * use the string returned from the method as the value of the
 * `WWW-Authenticate` header. The following is an example response from the
 * userinfo endpoint to the client application.
 *
 * ```
 * HTTP/1.1 401 Unauthorized
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoAction::$FORBIDDEN`, it means that the access token does not have
 * the `openid` scope.
 *
 * In this case, `getResponseContent()` method returns a string which describes
 * the error in the format of [RFC 6750](https://tools.ietf.org/html/rfc6750)
 * (OAuth 2.0 Bearer Token Usage), so the userinfo endpoint implementation can
 * use the string returned from the method as the value of the
 * `WWW-Authenticate` header. The following is an example response from the
 * userinfo endpoint to the client application.
 *
 * ```
 * HTTP/1.1 403 Forbidden
 * WWW-Authenticate: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `UserInfoAction::$OK`, it means that the access token which the client
 * application presented is valid. To be concrete, it means that the access
 * token exists, has not expired, has the `openid` scope, and is associated
 * with a subject (= an end-user).
 *
 * What the
 * [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo)
 * implementation of your system should do next is to collect information about
 * the subject (end-user) from your database. The value of the subject can be
 * obtained from `getSubject()` method, and the names of data, i.e., the claim
 * names, can be obtained from `getClaims()` method. For example, if
 * `getSubject()` method returns `joe123` and `getClaims()` method returns
 * `["given_name", "email"]`, you need to extract information about `joe123`'s
 * given name and email from your database.
 *
 * Then, call Authlete's `/api/auth/userinfo/issue` API with the collected
 * information and the access token in order to make Authlete generate a
 * userinfo response. See the description of `UserInfoIssueRequest` and
 * `UserInfoIssueResponse` for details about `/api/auth/userinfo/issue` API.
 *
 * If an error occurred during the above steps, generate an error response to
 * the client application. The response should comply with RFC 6750. For
 * example, if the subject associated with the access token does not exist in
 * your database any longer, you may feel like generating a response like
 * below.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * WWW-Authenticate: Bearer error="invalid_token",
 *   error_description="The user does not exist any longer."
 * Cache-Control: no-store
 * Pragram: no-cache
 * ```
 *
 * Also, an error might occur on database access. If you treat the error as an
 * internal server error, then the response would be like the following.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * WWW-Authenticate: Bearer error="server_error",
 *   error_description="Failed to access the database."
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 */
class UserInfoResponse extends ApiResponse
{
    private $action            = null;  // \Authlete\Dto\UserInfoAction
    private $clientId          = null;  // string or (64-bit) integer
    private $subject           = null;  // string
    private $scopes            = null;  // array of string
    private $claims            = null;  // array of string
    private $token             = null;  // string
    private $responseContent   = null;  // string
    private $properties        = null;  // array of \Authlete\Dto\Property
    private $clientIdAlias     = null;  // string
    private $clientIdAliasUsed = false; // boolean
    private $userInfoClaims    = null;  // string


    /**
     * Get the next action that the userinfo endpoint should take.
     *
     * @return UserInfoAction
     *     The next action that the userinfo endpoint should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the userinfo endpoint should take.
     *
     * @param UserInfoAction $action
     *     The next action that the userinfo endpoint should take.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setAction(UserInfoAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the ID of the client application to which the access token has been
     * issued.
     *
     * @return integer|string
     *     The client ID.
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * Set the ID of the client application to which the access token has been
     * issued.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setClientId($clientId)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user which is
     * associated with the access token.
     *
     * @return string
     *     The subject of the end-user.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user which is
     * associated with the access token.
     *
     * @param string $subject
     *     The subject of the end-user.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setSubject($subject)
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the scopes that the access token covers.
     *
     * @return string[]
     *     The scopes that the access token covers.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set the scopes that the access token covers.
     *
     * @param string[] $scopes
     *     The scopes that the access token covers.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the list of claims that the client application requests to be
     * embedded in the userinfo response.
     *
     * The value comes from the `scope` and/or `claims` request parameters of
     * the original authorization request. See
     * [5.4. Requesting Claims using Scope Values](https://openid.net/specs/openid-connect-core-1_0.html#ScopeClaims)
     * and
     * [5.5. Requesting Claims using the "claims" Request Parameter](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsParameter)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
     * for details.
     *
     * @return string[]
     *     The list of claims that the client application requests to be
     *     embedded in the userinfo response.
     */
    public function getClaims()
    {
        return $this->claims;
    }


    /**
     * Set the list of claims that the client application requests to be
     * embedded in the userinfo response.
     *
     * @param string[] $claims
     *     The list of claims that the client application requests to be
     *     embedded in the userinfo response.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setClaims(array $claims = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the access token that the userinfo endpoint received from the client
     * application.
     *
     * @return string
     *     The access token that the userinfo endpoint received from the client
     *     application.
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * Set the access token that the userinfo endpoint received from the client
     * application.
     *
     * @param string $token
     *     The access token that the userinfo endpoint received from the client
     *     application.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setToken($token)
    {
        ValidationUtility::ensureNullOrString('$token', $token);

        $this->token = $token;

        return $this;
    }


    /**
     * Get the response content which can be used as a part of the response to
     * the client application.
     *
     * @return string
     *     The response content.
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used as a part of the response to
     * the client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setResponseContent($responseContent)
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the properties associated with the access token.
     *
     * @return Property[]
     *     The troperties associated with the access token.
     */
    public function getProperties()
    {
        return $this->properties;
    }


    /**
     * Set the properties associated with the access token.
     *
     * @param Property[] $properties
     *     The troperties associated with the access token.
     *
     * @return UserInfoResponse
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
     * Get the client ID alias when the authorization request for the access
     * token was made.
     *
     * Note that this value may be different from the current client ID alias.
     *
     * @return string
     *     The client ID alias when the authorization request for the access
     *     token was made.
     */
    public function getClientIdAlias()
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the client ID alias when the authorization request for the access
     * token was made.
     *
     * @param string $alias
     *     The client ID alias when the authorization request for the access
     *     token was made.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setClientIdAlias($alias)
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias was used when
     * the authorization request for the access token was made.
     *
     * @return boolean
     *     `true` if the client ID alias was used when the authorization
     *     request for the access token was made.
     */
    public function isClientIdAliasUsed()
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether the client ID alias was used when
     * the authorization request for the access token was made.
     *
     * @param boolean $used
     *     `true` if the client ID alias was used when the authorization
     *     request for the access token was made.
     *
     * @return UserInfoResponse
     *     `$this` object.
     */
    public function setClientIdAliasUsed($used)
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the value of the `userinfo` property in the `claims` request
     * parameter or in the `claims` property in an authorization request
     * object.
     *
     * A client application may request certain claims be embedded in an
     * ID token or in a response from the UserInfo endpoint. There are
     * several ways. Including the `claims` request parameter and including
     * the `claims` property in a request object are such examples. In both
     * the cases, the value of the `claims` parameter/property is JSON. Its
     * format is described in
     * [5.5. Requesting Claims using the "claims" Request Parameter](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsParameter)
     * of
     * [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * The following is an excerpt from the specification. You can find
     * `userinfo` and `id_token` are top-level properties.
     *
     * ```
     * {
     *  "userinfo":
     *   {
     *    "given_name": {"essential": true},
     *    "nickname": null,
     *    "email": {"essential": true},
     *    "email_verified": {"essential": true},
     *    "picture": null,
     *    "http://example.info/claims/groups": null
     *   },
     *  "id_token":
     *   {
     *    "auth_time": {"essential": true},
     *    "acr": {"values": ["urn:mace:incommon:iap:silver"] }
     *   }
     * }
     * ```
     *
     * This method (`getUserInfoClaims`) returns the value of the `userinfo`
     * property in JSON format. For example, if the JSON above is included
     * in an authorization request, this method returns JSON equivalent to
     * the following.
     *
     * ```
     * {
     *  "given_name": {"essential": true},
     *  "nickname": null,
     *  "email": {"essential": true},
     *  "email_verified": {"essential": true},
     *  "picture": null,
     *  "http://example.info/claims/groups": null
     * }
     * ```
     *
     * Note that if a request object is given and it contains the `claims`
     * property and if the `claims` request parameter is also given, this
     * method returns the value in the former.
     *
     * @return string
     *     The value of the `userinfo` property in the `claims` in JSON
     *     format.
     *
     * @since 1.8
     */
    public function getUserInfoClaims()
    {
        return $this->userInfoClaims;
    }


    /**
     * Set the value of the `userinfo` property in the `claims` request
     * parameter or in the `claims` property in a request object.
     *
     * @param string $claims
     *     The value of the `userinfo` property in the `claims` in JSON
     *     format.
     *
     * @return UserInfoResponse
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setUserInfoClaims($claims)
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->userInfoClaims = $claims;

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

        $array['action']            = LanguageUtility::toString($this->action);
        $array['clientId']          = $this->clientId;
        $array['subject']           = $this->subject;
        $array['scopes']            = $this->scopes;
        $array['claims']            = $this->claims;
        $array['token']             = $this->token;
        $array['responseContent']   = $this->responseContent;
        $array['properties']        = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['clientIdAlias']     = $this->clientIdAlias;
        $array['clientIdAliasUsed'] = $this->clientIdAliasUsed;
        $array['userInfoClaims']    = $this->userInfoClaims;
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
            UserInfoAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // scopes
        $this->setScopes(
            LanguageUtility::getFromArray('scopes', $array));

        // claims
        $this->setClaims(
            LanguageUtility::getFromArray('claims', $array));

        // token
        $this->setToken(
            LanguageUtility::getFromArray('token', $array));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // properties
        $properties = LanguageUtility::getFromArray('properties', $array);
        $this->setProperties(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $properties, __NAMESPACE__ . '\Property'));

        // clientIdAlias
        $this->setClientIdAlias(
            LanguageUtility::getFromArray('clientIdAlias', $array));

        // clientIdAliasUsed
        $this->setClientIdAliasUsed(
            LanguageUtility::getFromArrayAsBoolean('clientIdAlias', $array));

        // userInfoClaims
        $this->setUserInfoClaims(
            LanguageUtility::getFromArray('userInfoClaims', $array));
    }
}
?>
