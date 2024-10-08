<?php
//
// Copyright (C) 2018-2024 Authlete, Inc.
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
 * File containing the definition of AuthorizationIssueResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/authorization/issue API.
 *
 * Authlete's `/api/auth/authorization/issue` API returns JSON which can be
 * mapped to this class. The authorization server implementation should
 * retrieve the value of the `action` response parameter (which can be
 * obtained by `getAction()` method) from the response and take the following
 * steps according to the value.
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationIssueAction::$INTERNAL_SERVER_ERROR`, it means that the
 * request from the authorization server implementation was wrong or that an
 * error ocurred in Authlete. In either case, from a viewpoint of the client
 * application, it is an error on the server side. Therefore, the
 * authorization server implementation should generate a response to the
 * client application with the HTTP status of `500 Internal Server Error`.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the authorization server
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
 * `AuthorizationIssueAction::$BAD_REQUEST`, it means that the ticket is no
 * longer valid (deleted or expired) and that the reason of the invalidity
 * was probably due to the end-user's too-delayed response to the
 * authorization UI.
 *
 * The HTTP status of the response returned to the client application should
 * be `400 Bad Request` and the content type should be `application/json`
 * although OAuth 2.0 specification does not mention the format of the error
 * response for this case.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the authorization server
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
 * When the value returned from `getAction()` method is
 * `AuthorizationIssueAction::$LOCATION`, it means that the response to the
 * client application should be `302 Found` with a `Location` header.
 *
 * In this case, `getResponseContent()` method returns a redirect URI which
 * contains (1) an authorization code, an ID token and/or an access token
 * (on success) or (2) an error code (on failure), so it can be used as the
 * value of `Location` header. The following illustrates the response which
 * the authorization server implementation should generate and return to the
 * client application.
 *
 * ```
 * HTTP/1.1 302 Found
 * Location: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationIssueAction::$FORM`, it means that the response to the
 * client application should be `200 OK` with an HTML which triggers
 * redirection by JavaScript. This happens when the authorization request
 * from the client application contains `response_mode=form_post`.
 *
 * In this case, `getResponseContent()` method returns an HTML which
 * satisfies the requirements of `response_mode=form_post`, so it can be
 * used as the entity body of the response. The following illustrates the
 * response which the authorization server implementation should generate
 * and return to the client application.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: text/html;charset=UTF-8
 * Cache-Control: no-store
 * Pragma: no-store
 *
 * (The value returned from getResponseContent())
 * ```
 */
class AuthorizationIssueResponse extends ApiResponse
{
    private $action               = null;  // \Authlete\Dto\AuthorizationIssueAction
    private $responseContent      = null;  // string
    private $accessToken          = null;  // string
    private $accessTokenExpiresAt = null;  // string or (64-bit) integer
    private $accessTokenDuration  = null;  // string or (64-bit) integer
    private $idToken              = null;  // string
    private $authorizationCode    = null;  // string
    private $jwtAccessToken       = null;  // string
    private $ticketInfo           = null;  // \Authlete\Dto\AuthorizationTicketInfo


    /**
     * Get the next action that the authorization server implementation
     * should take.
     *
     * @return AuthorizationIssueAction
     *     The next action that the authorization server implementation
     *     should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the authorization server implementation
     * should take.
     *
     * @param AuthorizationIssueAction $action
     *     The next action that the authorization server implementation
     *     should take.
     *
     * @return AuthorizationIssueResponse
     *     `$this` object.
     */
    public function setAction(AuthorizationIssueAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the response content which can be used to generate a response to
     * the client application.
     *
     * The format of the value varies depending on the value returned from
     * `getAction()` method.
     *
     * @return string
     *     The response content which can be used to generate a response to
     *     the client application.
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used to generate a response to
     * the client application.
     *
     * @param string $responseContent
     *     The response content which can be used to generate a response to
     *     the client application.
     *
     * @return AuthorizationIssueResponse
     *     `$this` object.
     */
    public function setResponseContent($responseContent)
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the access token.
     *
     * An access token is issued when the `response_type` request parameter
     * of the authorization request includes `token`.
     *
     * If the service is configured to issue JWT-based access tokens, a
     * JWT-based access token is issued additionally. In the case,
     * `getJwtAccessToken()` returns the JWT-based access token.
     *
     * @return string
     *     The newly issued access token.
     *
     * @since 1.8
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the access token.
     *
     * @param string $accessToken
     *     The access token.
     *
     * @return AuthorizationIssueResponse
     *     `$this` object.
     *
     * @since 1.8
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
     *
     * @since 1.8
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
     * @return AuthorizationIssueResponse
     *     `$this` object.
     *
     * @since 1.8
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
     *
     * @since 1.8
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
     * @return AuthorizationIssueResponse
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the newly issued ID token.
     *
     * An ID token is issued when the `response_type` request parameter of the
     * authorization request includes `id_token`.
     *
     * @return string
     *     The newly issued ID token.
     *
     * @since 1.8
     */
    public function getIdToken()
    {
        return $this->idToken;
    }


    /**
     * Set the newly issued ID token.
     *
     * @param string $idToken
     *     The newly issued ID token.
     *
     * @return AuthorizationIssueResponse
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setIdToken($idToken)
    {
        ValidationUtility::ensureNullOrString('$idToken', $idToken);

        $this->idToken = $idToken;

        return $this;
    }


    /**
     * Get the newly issued authorization code.
     *
     * An authorization code is issued when the `response_type` request
     * parameter of the authorization request includes `code`.
     *
     * @return string
     *     The newly issued authorization code.
     *
     * @since 1.8
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }


    /**
     * Set the newly issued authorization code.
     *
     * @param string $code
     *     The newly issued authorization code.
     *
     * @return AuthorizationIssueResponse
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAuthorizationCode($code)
    {
        ValidationUtility::ensureNullOrString('$code', $code);

        $this->authorizationCode = $code;

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
     * @return AuthorizationIssueResponse
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
     * Get the information about the ticket that was presented to the
     * `/auth/authorization/issue` API.
     *
     * @return AuthorizationTicketInfo
     *     The information about the ticket.
     *
     * @since 1.13.0 Available since Authlete 3.0.
     */
    public function getTicketInfo()
    {
        return $this->ticketInfo;
    }


    /**
     * Set the information about the ticket that was presented to the
     * `/auth/authorization/issue` API.
     *
     * @param AuthorizationTicketInfo $info
     *     The information about the ticket.
     *
     * @return AuthorizationIssueResponse
     *     `$this` object.
     *
     * @since 1.13.0 Available since Authlete 3.0.
     */
    public function setTicketInfo(AuthorizationTicketInfo $info = null)
    {
        $this->ticketInfo = $info;

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

        $array['action']               = LanguageUtility::toString($this->action);
        $array['responseContent']      = $this->responseContent;
        $array['accessToken']          = $this->accessToken;
        $array['accessTokenExpiresAt'] = LanguageUtility::orZero($this->accessTokenExpiresAt);
        $array['accessTokenDuration']  = LanguageUtility::orZero($this->accessTokenDuration);
        $array['idToken']              = $this->idToken;
        $array['authorizationCode']    = $this->authorizationCode;
        $array['jwtAccessToken']       = $this->jwtAccessToken;
        $array['ticketInfo']           = LanguageUtility::convertArrayCopyableToArray($this->ticketInfo);
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
            AuthorizationIssueAction::valueOf(
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

        // idToken
        $this->setIdToken(
            LanguageUtility::getFromArray('idToken', $array));

        // authorizationCode
        $this->setAuthorizationCode(
            LanguageUtility::getFromArray('authorizationCode', $array));

        // jwtAccessToken
        $this->setJwtAccessToken(
            LanguageUtility::getFromArray('jwtAccessToken', $array));

        // ticketInfo
        $_ticketInfo = LanguageUtility::getFromArray('ticketInfo', $array);
        $this->setTicketInfo(
            LanguageUtility::convertArrayToArrayCopyable(
                $_ticketInfo, __NAMESPACE__ . '\AuthorizationTicketInfo'));
    }
}
?>
