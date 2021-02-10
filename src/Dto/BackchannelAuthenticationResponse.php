<?php
//
// Copyright (C) 2020-2021 Authlete, Inc.
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
 * File containing the definition of BackchannelAuthenticationResponse class.
 */


namespace Authlete\Dto;


use Authlete\Dto\Scope;
use Authlete\Types\DeliveryMode;
use Authlete\Types\UserIdentificationHintType;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/backchannel/authentication API.
 *
 * Authlete's `/api/backchannel/authentication` API returns JSON which can be
 * mapped to this class. The authorization server implementation should
 * retrieve the value of the `action` response parameter (which can be obtained
 * by `getAction()` method) from the response and take the following steps
 * according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationAction::$BAD_REQUEST`, it means that the
 * backchannel authentication request from the client application was wrong.
 *
 * The authorization server implementation should generate a response to the
 * client application with `400 Bad Request` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
 *
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
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationAction::$UNAUTHORIZED`, it means that client
 * authentication of the backchannel authentication request failed. Note that
 * client authentication is always required at the backchannel authentication
 * endpoint. This implies that public clients are not allowed to use the
 * backchannel authentication endpoint.
 *
 * The authorization server implementation should generate a response to the
 * client application with `401 Unauthorized` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
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
 * `BackchannelAuthenticationAction::$INTERNAL_SERVER_ERROR`, it means that the
 * API call from the authorization server implementation was wrong or that an
 * error occurred in Authlete.
 *
 * In either case, from a viewpoint of the client application, it is an error
 * on the server side. Therefore, the authorization server implementation
 * should generate a response to the client application with
 * `500 Internal Server Error` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes the
 * error, so it can be used as the entity body of the response.
 *
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
 * ---
 *
 * When the value returned from `getAction()` method is
 * `BackchannelAuthenticationAction::$USER_IDENTIFICATION`, it means that the
 * backchannel authentication request from the client application is valid. The
 * authorization server implementation has to follow the steps below.
 *
 * + **[END-USER IDENTIFICATION]**
 *
 *     The first step is to determine the subject (= unique identifier) of the
 *     end-user from whom the client application wants to get authorization.
 *
 *     According to the CIBA specification, a backchannel authentication
 *     request contains one (and only one) of the `login_hint_token`,
 *     `id_token_hint` and `login_hint` request parameters as a hint by which
 *     the authorization server identifies the subject of an end-user.
 *
 *     The authorization server implementation can know which hint is included
 *     in the backchannel authentication request by calling the `getHintType()`
 *     method. The method returns a `UserIdentificationHintType` instance that
 *     indicates which hint is included. For example, when the method returns
 *     `UserIdentificationHintType::$LOGIN_HINT`, it means that the backchannel
 *     authentication request contains the `login_hint` request parameter as a
 *     hint.
 *
 *     The `getHint()` method returns the value of the hint. For example, when
 *     the `getHintType()` method returns `LOGIN_HINT`, the `getHint()` method
 *     returns the value of the `login_hint` request parameter.
 *
 *     It is up to the authorization server implementation how to determine the
 *     subject of the end-user from the hint. There are few things Authlete can
 *     help. Only one thing Authlete can do is to let the `getSub()` method
 *     return the value of the `sub` claim in the `id_token_hint` request
 *     parameter when the request parameter is used.
 *
 * <br/>
 * + **[END-USER IDENTIFICATION ERROR]**
 *
 *     There are some cases where the authorization server implementation
 *     encounters an error during the user identification process. In any error
 *     case, the authorization server implementation has to return an HTTP
 *     response with the `error` response parameter to the client application.
 *     The following is an example of such error responses.
 *
 *     ```
 *     HTTP/1.1 400 Bad Request
 *     Content-Type: application/json
 *     Cache-Control: no-store
 *     Pragma: no-cache
 *
 *     {"error":"unknown_user_id"}
 *     ```
 *
 *     Authlete provides `/api/backchannel/authentication/fail` API that builds
 *     the response body (JSON) of an error response. However, because it is
 *     easy to build an error response manually, you may choose not to call the
 *     API. One good thing in using the API is that the API call can trigger
 *     deletion of the ticket which has been issued from Authlete's
 *     `/api/backchannel/authentication` API. If you don't call
 *     `/api/backchannel/authentication/fail` API, the ticket will continue to
 *     exist in the database until it is cleaned up by the batch program after
 *     the ticket expires.
 *
 *     Possible error cases that the authorization server implementation itself
 *     has to handle are as follows. Other error cases have already been
 *     covered by `/api/backchannel/authentication` API.
 *
 *     1. `expired_login_hint_token`:
 *         The authorization server implementation detected that the hint
 *         presented by the `login_hint_token` request parameter has expired.
 *         Note that the format of `login_hint_token` is not described in the
 *         CIBA Core spec at all and so there is no consensus on how to detect
 *         expiration of `login_hint_token`. Interpretation of
 *         `login_hint_token` is left to each authorization server
 *         implementation.
 *
 *     2. `unknown_user_id`:
 *         The authorization server implementation could not determine the
 *         subject of the end-user by the presented hint.
 *
 *     3. `unauthorized_client`:
 *         The authorization server implementation has custom rules to reject
 *         backchannel authentication requests from some particular clients and
 *         found that the client which has made the backchannel authentication
 *         request is one of the particular clients.
 *         Note that `/api/backchannel/authentication` API does not return
 *         `"action":"USER_IDENTIFICATION"` in cases where the client does not
 *         exist or client authentication has failed. Therefore, the
 *         authorization server implementation will never have to use the error
 *         code `unauthorized_client` unless the server has intentionally
 *         implemented custom rules to reject backchannel authentication
 *         requests based on clients.
 *
 *     4. `missing_user_code`:
 *         The authorization server implementation has custom rules to require
 *         that a backchannel authentication request include a user code for
 *         some particular users and found that the user identified by the hint
 *         is one of the particular users.
 *         Note that `/api/backchannel/authentication` API does not return
 *         `"action":"USER_IDENTIFICATION"` when both the
 *         `backchannel_user_code_parameter_supported` metadata of the serveer
 *         and the `backchannel_user_code_parameter` metadata of the client are
 *         `true` and the backchannel authentication request does not include
 *         the `user_code` request parameter. In this case,
 *         `/api/backchannel/authentication` API returns
 *         `"action":"BAD_REQUEST"` with JSON containing
 *         `"error":"missing_user_code"`. Therefore, the authorization server
 *         implementation will never have to use the error code
 *         `missing_user_code` unless the server has intentionally implemented
 *         custom rules to require a user code based on users even in the case
 *         where the `backchannel_user_code_parameter` metadata of the client
 *         which has made the backchannel authentication request is `false`.
 *
 *     5. `invalid_user_code`:
 *         The authorization server implementation detected that the presented
 *         user code is invalid.
 *         Note that the format of `user_code` is not described in the CIBA
 *         Core spec at all and so there is no consensus on how to judge
 *         whether a user code is valid or not. It is up to each authorization
 *         server implementation how to handle user codes.
 *
 *     6. `invalid_binding_message`:
 *         The authorization server implementation detected that the presented
 *         binding message is invalid.
 *         Note that the format of `binding_message` is not described in the
 *         CIBA Core spec at all and so there is no consensus on how to judge
 *         whether a binding message is valid or not. It is up to each
 *         authorization server implementation how to handle binding messages.
 *
 *     7. `invalid_target`:
 *         The authorization server implementation rejects the requested target
 *         resources.
 *         The error code `invalid_target` is from RFC 8707 (Resource
 *         Indicators for OAuth 2.0). The specification defines the `resource`
 *         request parameter. By using the parameter, client applications can
 *         request target resources that should be bound to the access token
 *         being issued. If the authorization server wants to reject the
 *         request, call `/api/backchannel/authentication/fail` API with
 *         `INVALID_TARGET`.
 *         Note that RFC 8707 is supported since Authlete 2.2. Older versions
 *         don't recognize the `resource` request parameter, so
 *         `getResources()` always returns null if the Authlete server you are
 *         using is older than 2.2.
 *
 *     8. `access_denined`:
 *         The authorization server implementation has custom rules to reject
 *         backchannel authentication requests without asking the end-user and
 *         respond to the client as if the end-user had rejected the request in
 *         some particular cases and found that the backchannel authentication
 *         request is one of the particular cases.
 *         The authorization server implementation will never have to use the
 *         error code `access_denied` at this timing unless the server has
 *         intentionally implemented custom rules to reject backchannel
 *         authentication requests without asking the end-user and respond to
 *         the client as if the end-user had rejected the request.
 *
 * <br/>
 * + **[AUTH_REQ_ID ISSUE]**
 *
 *     If the authorization server implementation has successfully determined
 *     the subject of the end-user, the next action is to return an HTTP
 *     response to the client application which contains `auth_req_id`.
 *
 *     Authlete provides `/api/backchannel/authentication/issue` API which
 *     generates a JSON containing `auth_req_id`, so, your next action is (1)
 *     call the API, (2) receive the response from the API, (3) build a
 *     response to the client application using the content of the API
 *     response, and (4) return the response to the client application. See the
 *     description `/api/backchannel/authentication/issue` API for details.
 *
 * <br/>
 * + **[END-USER AUTHENTICATION AND AUTHORIZATION]**
 *
 *     After sending a JSON containing `auth_req_id` back to the client
 *     application, the authorization server implementation starts to
 *     communicate with an authentication device of the end-user. It is assumed
 *     that end-user authentication is performed on the authentication device
 *     and the end-user confirms the content of the backchannel authentication
 *     request and grants authorization to the client application if everything
 *     is okay. The authorization server implementation must be able to receive
 *     the result of the end-user authentication and authorization from the
 *     authentication device.
 *
 *     How to communicate with an authentication device and achieve end-user
 *     authentication and authorization is up to each authorization server
 *     implementation, but the following request parameters of the backchannel
 *     authentication request should be taken into consideration in any
 *     implementation.
 *
 *     1. `acr_values`:
 *         A backchannel authentication request may contain an array of ACRs
 *         (Authentication Context Class References) in preference order. If
 *         multiple authentication devices are registered for the end-user,
 *         the authorization server implementation should take the ACRs into
 *         consideration when selecting the best authentication device.
 *
 *     2. `scope`:
 *         A backchannel authentication request always contains a list of
 *         scopes. At least, `openid` is included in the list (otherwise
 *         `/api/backchannel/authentication` API returns
 *         `"action":"BAD_REQUEST"`). It would be better to show the requested
 *         scopes to the end-user on the authentication device or somewhere
 *         appropriate.
 *         If the `scope` request parameter contains `address`, `email`,
 *         `phone` and/or `profile`, they are interpreted as defined in
 *         "5.4. Requesting Claims using Scope Values" of OpenID Connect Core
 *         1.0. That is, they are expanded into a list of claim names.
 *         The `getClaimNames()` method returns the expanded result.
 *
 *     3. `binding_message`:
 *         A backchannel authentication request may contain a binding message.
 *         It is a human readable identifier or message intended to be
 *         displayed on both the consumption device (client application) and
 *         the authentication device.
 *
 *     4. `user_code`:
 *         A backchannel authentication request may contain a user code.
 *         It is a secret code, such as password or pin, known only to the
 *         end-user but verifiable by the authorization server. The user code
 *         should be used to authorize sending a request to the authentication
 *         device.
 *
 * <br/>
 * + **[END-USER AUTHENTICATION AND AUTHORIZATION COMPLETION]**
 *
 *     After receiving the result of end-user authentication and authorization,
 *     the authorization server implementation must call Authlete's
 *     `/api/backchannel/authentication/complete` API to tell Authlete the
 *     result and pass necessary data so that Authlete can generate an ID
 *     token, an access token and optionally a refresh token. See the
 *     description of the API for details.
 *
 * <br/>
 * + **[CLIENT NOTIFICATION]**
 *
 *     When the backchannel token delivery mode is either "ping" or "push", the
 *     authorization server implementation must send a notification to the
 *     pre-registered notification endpoint of the client after the end-user
 *     authentication and authorization. In this case, the `getAction()` method
 *     `BackchannelAuthenticationCompleteResponse` (a response from
 *     `/api/backchannel/authentication/complete` API) returns `NOTIFICATION`.
 *     See the description of `/api/backchannel/authentication/complete` API
 *     for details.
 *
 * <br/>
 * + **[TOKEN REQUEST]**
 *
 *     When the backchannel token delivery mode is either "ping" or "poll", the
 *     client application will make a token request to the token endpoint to
 *     get an ID token, an access token and optionally a refresh token.
 *
 *     A token request that corresponds to a backchannel authentication request
 *     uses `urn:openid:params:grant-type:ciba` as the value of the
 *     `grant_type` request parameter. Authlete's `/api/auth/token` API
 *     recognizes the grant type automatically and behaves properly, so the
 *     existing token endpoint implementation does not have to be changed to
 *     support CIBA.
 *
 * @since 1.8
 */
class BackchannelAuthenticationResponse extends ApiResponse
{
    private $action                  = null;  // \Authlete\Dto\BackchannelAuthenticationAction
    private $responseContent         = null;  // string
    private $clientId                = null;  // string or (64-bit) integer
    private $clientIdAlias           = null;  // string
    private $clientIdAliasUsed       = false; // boolean
    private $clientName              = null;  // string
    private $deliveryMode            = null;  // \Authlete\Types\DeliveryMode
    private $scopes                  = null;  // array of \Authlete\Dto\Scope
    private $claimNames              = null;  // array of string
    private $clientNotificationToken = null;  // string
    private $acrs                    = null;  // array of string
    private $hintType                = null;  // \Authlete\Types\UserIdentificationHintType
    private $hint                    = null;  // string
    private $sub                     = null;  // string
    private $bindingMessage          = null;  // string
    private $userCode                = null;  // string
    private $userCodeRequired        = false; // boolean
    private $requestedExpiry         = 0;     // integer
    private $requestContext          = null;  // string
    private $resources               = null;  // array of string
    private $warnings                = null;  // array of string
    private $ticket                  = null;  // string


    /**
     * Get the next action that the implementation of the backchannel
     * authentication endpoint should take.
     *
     * @return BackchannelAuthenticationAction
     *     The next action.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the implementation of the backchannel
     * authentication endpoint should take.
     *
     * @param BackchannelAuthenticationAction $action
     *     The next action.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setAction(BackchannelAuthenticationAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the content that can be used to generate a response to the client
     * application.
     *
     * When this method returns a non-null value, it is JSON containing error
     * information. When `getAction()` returns `USER_IDENTIFICATION`, this
     * method returns null.
     *
     * @return string
     *     The content of a response to the client.
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }


    /**
     * Set the content that can be used to generate a response to the client
     * application.
     *
     * @param string $responseContent
     *     The content of a response to the client.
     *
     * @return BackchannelAuthenticationResponse
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
     * @return BackchannelAuthenticationResponse
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
     * @return BackchannelAuthenticationResponse
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
     * @return BackchannelAuthenticationResponse
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
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setClientName($name)
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->clientName = $name;

        return $this;
    }


    /**
     * Get the backchannel token delivery mode of the client application.
     *
     * @return DeliveryMode
     *     The backchannel token delivery mode.
     */
    public function getDeliveryMode()
    {
        return $this->deliveryMode;
    }


    /**
     * Set the backchannel token delivery mode of the client application.
     *
     * @param DeliveryMode $mode
     *     The backchannel token delivery mode.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setDeliveryMode(DeliveryMode $mode = null)
    {
        $this->deliveryMode = $mode;

        return $this;
    }


    /**
     * Get the scopes requested by the backchannel authentication request.
     *
     * Basically, this method returns the value of the `scope` request parameter
     * in the backchannel authentication request. However, because unregistered
     * scopes are dropped on Authlete side, if the `scope` request parameter
     * contains unknown scopes, the list returned by this method becomes
     * different from the value of the `scope` request parameter.
     *
     * Note that `Scope.getDescription()` method and `Scope.getDescriptions()`
     * method of each element (`Scope` instance) in the array returned from
     * this method always return `null` even if descriptions of the scopes are
     * registered.
     *
     * @return Scope[]
     *     The requested scopes.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set the scopes requested by the backchannel authentication request.
     *
     * @param Scope[] $scopes
     *     The requested scopes.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$scopes', $scopes, __NAMESPACE__ . '\Scope');

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the names of the claims which were requested indirectly via some
     * special scopes. See [5.4. Requesting Claims using Scope Values](https://openid.net/specs/openid-connect-core-1_0.html#ScopeClaims)
     * in [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html#ScopeClaims)
     * for details.
     *
     * @return string[]
     *     The names of the requested claims.
     */
    public function getClaimNames()
    {
        return $this->claimNames;
    }


    /**
     * Set the names of the claims which were requested indirectly via some
     * special scopes.
     *
     * @param string[] $names
     *     The names of the requested claims.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setClaimNames(array $names = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$names', $names);

        $this->claimNames = $names;

        return $this;
    }


    /**
     * Get the client notification token included in the backchannel
     * authentication request. It is the value of the
     * `client_notification_token` request parameter.
     *
     * When the backchannel token delivery mode is "ping" or "push", the
     * backchannel authentication request must include a client notification
     * token.
     *
     * @return string
     *     The client notification token.
     */
    public function getClientNotificationToken()
    {
        return $this->clientNotificationToken;
    }


    /**
     * Set the client notification token included in the backchannel
     * authentication request. It is the value of the
     * `client_notification_token` request parameter.
     *
     * When the backchannel token delivery mode is "ping" or "push", the
     * backchannel authentication request must include a client notification
     * token.
     *
     * @param string $token
     *     The client notification token.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setClientNotificationToken($token)
    {
        ValidationUtility::ensureNullOrString('$token', $token);

        $this->clientNotificationToken = $token;

        return $this;
    }


    /**
     * Get the list of ACR values requestsed by the backchannel authentication
     * request.
     *
     * Basically, this method returns the value of the `acr_values` request
     * parameter in the backchannel authentication request. However, because
     * unsupported ACR values are dropped on Authlete side, if the `acr_values`
     * request parameter contains unrecognized ACR values, the list returned
     * by this method becomes different from the value of the `acr_values`
     * request parameter.
     *
     * @return string[]
     *     The list of requested ACR values.
     */
    public function getAcrs()
    {
        return $this->acrs;
    }


    /**
     * Set the list of ACR values requestsed by the backchannel authentication
     * request.
     *
     * @param string[] $acrs
     *     The list of requested ACR values.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setAcrs(array $acrs = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$acrs', $acrs);

        $this->acrs = $acrs;

        return $this;
    }


    /**
     * Get the type of the hint for end-user identification which was
     * included in the backchannel authentication request.
     *
     * When the backchannel authentication request contains `id_token_hint`,
     * this method returns `UserIdentificationHintType::$ID_TOKEN_HINT`.
     * Likewise, this method returns `UserIndentificationHintType::$LOGIN_HINT`
     * when the request contains `login_hint`, or returns
     * `UserIdentificationHintType::$LOGIN_HINT_TOKEN` when the request
     * contains `login_hint_token`.
     *
     * Note that a backchannel authentication request must include one and
     * only one hint among `id_token_hint`, `login_hint` and
     * `login_hint_token`.
     *
     * @return DeliveryMode
     *     The type of the hint for end-user identification.
     */
    public function getHintType()
    {
        return $this->hintType;
    }


    /**
     * Set the type of the hint for end-user identification which was
     * included in the backchannel authentication request.
     *
     * @param UserIdentificationHintType $hintType
     *     The type of the hint for end-user identification.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setHintType(UserIdentificationHintType $hintType = null)
    {
        $this->hintType = $hintType;

        return $this;
    }


    /**
     * Get the value of the hint for end-user identification.
     *
     * When `getHintType()` returns
     * `UserIdentificationHintType::$ID_TOKEN_HINT`, this method returns the
     * value of the `id_token_hint` request parameter. Likewise, this method
     * returns the value of the `login_hint` request parameter when
     * `getHintType()` returns `UserIdentificationHintType::$LOGIN_HINT`, or
     * returns the value of the `login_hint_token` request parameter when
     * `getHintType()` returns `UserIdentificationHintType::$LOGIN_HINT_TOKEN`.
     *
     * @return string
     *     The value of the hint for end-user identification.
     */
    public function getHint()
    {
        return $this->hint;
    }


    /**
     * Set the value of the hint for end-user identification.
     *
     * @param string $hint
     *     The value of the hint for end-user identification.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setHint($hint)
    {
        ValidationUtility::ensureNullOrString('$hint', $hint);

        $this->hint = $hint;

        return $this;
    }


    /**
     * Get the value of the `sub` claim contained in the ID token hint
     * included in the backchannel authentication request.
     *
     * This method works only when the backchannel authentication request
     * contains the `id_token_hint` request parameter.
     *
     * @return string
     *     The value of the `sub` claim contained in the ID token hint.
     */
    public function getSub()
    {
        return $this->sub;
    }


    /**
     * Set the value of the `sub` claim contained in the ID token hint
     * included in the backchannel authentication request.
     *
     * @param string $sub
     *     The value of the `sub` claim contained in the ID token hint.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setSub($sub)
    {
        ValidationUtility::ensureNullOrString('$sub', $sub);

        $this->sub = $sub;

        return $this;
    }


    /**
     * Get the binding message included in the backchannel authentication
     * request. It is the value of the `binding_message` request parameter.
     *
     * @return string
     *     The binding message.
     */
    public function getBindingMessage()
    {
        return $this->bindingMessage;
    }


    /**
     * Set the binding message included in the backchannel authentication
     * request. It is the value of the `binding_message` request parameter.
     *
     * @param string $message
     *     The binding message.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setBindingMessage($message)
    {
        ValidationUtility::ensureNullOrString('$message', $message);

        $this->bindingMessage = $message;

        return $this;
    }


    /**
     * Get the user code included in the backchannel authentication request.
     * It is the value of the `user_code` request parameter.
     *
     * @return string
     *     The user code.
     */
    public function getUserCode()
    {
        return $this->userCode;
    }


    /**
     * Set the user code included in the backchannel authentication request.
     *
     * @param string $code
     *     The user code.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setUserCode($code)
    {
        ValidationUtility::ensureNullOrString('$code', $code);

        $this->userCode = $code;

        return $this;
    }


    /**
     * Get the flag which indicates whether a user code is required.
     *
     * This method returns `true` when both the
     * `backchannel_user_code_parameter` metadata of the client
     * (`Client.bcUserCodeRequired` property) and the
     * `backchannel_user_code_parameter_supported` metadata of the service
     * (`Service.backchannelUserCodeParameterSupported` property) are `true`.
     *
     * @return boolean
     *     `true` when a user code is required.
     */
    public function isUserCodeRequired()
    {
        return $this->userCodeRequired;
    }


    /**
     * Set the flag which indicates whether a user code is required.
     *
     * @param boolean $required
     *     `true` to indicate that a user code is required.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setUserCodeRequired($required)
    {
        ValidationUtility::ensureBoolean('$required', $required);

        $this->userCodeRequired = $required;

        return $this;
    }


    /**
     * Get the requested expiry for the authentication request ID
     * (`auth_req_id`). It is the value of the `requested_expiry` request
     * parameter.
     *
     * @return integer
     *     The requested expiry in seconds.
     */
    public function getRequestedExpiry()
    {
        return $this->requestedExpiry;
    }


    /**
     * Set the requested expiry for the authentication request ID
     * (`auth_req_id`). It is the value of the `requested_expiry` request
     * parameter.
     *
     * @param integer $seconds
     *     The requested expiry in seconds.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setRequestedExpiry($seconds)
    {
        ValidationUtility::ensureInteger('$seconds', $seconds);

        $this->requestedExpiry = $seconds;

        return $this;
    }


    /**
     * Get the request context of the backchannel authentication request. It
     * is the value of the `request_context` claim in the signed authentication
     * request and its format is JSON. `request_context` is a new claim added
     * by the FAPI-CIBA profile.
     *
     * This method returns null if the backchannel authentication request does
     * not include a `request` request parameter or the JWT specified by the
     * request parameter does not include a `request_context` claim.
     *
     * @return string
     *     The request context in JSON format.
     */
    public function getRequestContext()
    {
        return $this->requestContext;
    }


    /**
     * Set the request context of the backchannel authentication request. It
     * is the value of the `request_context` claim in the signed authentication
     * request and its format is JSON. `request_context` is a new claim added
     * by the FAPI-CIBA profile.
     *
     * @param string $context
     *     The request context in JSON format.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setRequestContext($context)
    {
        ValidationUtility::ensureNullOrString('$context', $context);

        $this->requestContext = $context;

        return $this;
    }


    /**
     * Get the resources specified by the `resource` request parameters or by
     * the `resource` property in the request object. If both are given, the
     * values in the request object take precedence.
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
     * the `resource` property in the request object. If both are given, the
     * values in the request object take precedence.
     *
     * @param string[] $resources
     *     The target resources.
     *
     * @return BackchannelAuthenticationResponse
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
     * Get the warnings raised during processing the backchannel authentication
     * request.
     *
     * @return string[]
     *     Warnings. This may be null.
     */
    public function getWarnings()
    {
        return $this->warnings;
    }


    /**
     * Set the warnings raised during processing the backchannel authentication
     * request.
     *
     * @param string[] $warnings
     *     Warnings
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setWarnings(array $warnings = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$warnings', $warnings);

        $this->warnings = $warnings;

        return $this;
    }


    /**
     * Get the ticket that is necessary for the implementation of the
     * backchannel authentication endpoint to call
     * `/api/backchannel/authentication/*` API.
     *
     * @return string
     *     The ticket issued from `/api/backchannel/authentication` API.
     */
    public function getTicket()
    {
        return $this->ticket;
    }


    /**
     * Set the ticket that is necessary for the implementation of the
     * backchannel authentication endpoint to call
     * `/api/backchannel/authentication/*` API.
     *
     * @param string $ticket
     *     The ticket issued from `/api/backchannel/authentication` API.
     *
     * @return BackchannelAuthenticationResponse
     *     `$this` object.
     */
    public function setTicket($ticket)
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

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

        $array['action']                  = LanguageUtility::toString($this->action);
        $array['responseContent']         = $this->responseContent;
        $array['clientId']                = $this->clientId;
        $array['clientIdAlias']           = $this->clientIdAlias;
        $array['clientIdAliasUsed']       = $this->clientIdAliasUsed;
        $array['clientName']              = $this->clientName;
        $array['deliveryMode']            = LanguageUtility::toString($this->deliveryMode);
        $array['scopes']                  = LanguageUtility::convertArrayOfArrayCopyableToArray($this->scopes);
        $array['claimNames']              = $this->claimNames;
        $array['clientNotificationToken'] = $this->clientNotificationToken;
        $array['acrs']                    = $this->acrs;
        $array['hintType']                = LanguageUtility::toString($this->hintType);
        $array['hint']                    = $this->hint;
        $array['sub']                     = $this->sub;
        $array['bindingMessage']          = $this->bindingMessage;
        $array['userCode']                = $this->userCode;
        $array['userCodeRequired']        = $this->userCodeRequired;
        $array['requestedExpiry']         = LanguageUtility::orZero($this->requestedExpiry);
        $array['requestContext']          = $this->requestContext;
        $array['resources']               = $this->resources;
        $array['warnings']                = $this->warnings;
        $array['ticket']                  = $this->ticket;
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
            BackchannelAuthenticationAction::valueOf(
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

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $_scopes = LanguageUtility::convertArrayToArrayOfArrayCopyable($_scopes, __NAMESPACE__ . '\Scope');
        $this->setScopes($_scopes);

        // claimNames
        $_claim_names = LanguageUtility::getFromArray('claimNames', $array);
        $this->setClaimNames($_claim_names);

        // clientNotificationToken
        $this->setClientNotificationToken(
            LanguageUtility::getFromArray('clientNotificationToken', $array));

        // acrs
        $_acrs = LanguageUtility::getFromArray('acrs', $array);
        $this->setAcrs($_acrs);

        // hintType
        $this->setHintType(
            UserIdentificationHintType::valueOf(
                LanguageUtility::getFromArray('hintType', $array)));

        // hint
        $this->setHint(
            LanguageUtility::getFromArray('hint', $array));

        // sub
        $this->setSub(
            LanguageUtility::getFromArray('sub', $array));

        // bindingMessage
        $this->setBindingMessage(
            LanguageUtility::getFromArray('bindingMessage', $array));

        // userCode
        $this->setUserCode(
            LanguageUtility::getFromArray('userCode', $array));

        // userCodeRequired
        $this->setUserCodeRequired(
            LanguageUtility::getFromArrayAsBoolean('userCodeRequired', $array));

        // requestedExpiry
        $this->setRequestedExpiry(
            LanguageUtility::getFromArray('requestedExpiry', $array));

        // requestContext
        $this->setRequestContext(
            LanguageUtility::getFromArray('requestContext', $array));

        // resources
        $_resources = LanguageUtility::getFromArray('resources', $array);
        $this->setResources($_resources);

        // warnings
        $_warnings = LanguageUtility::getFromArray('warnings', $array);
        $this->setWarnings($_warnings);

        // ticket
        $this->setTicket(
            LanguageUtility::getFromArray('ticket', $array));
    }
}
?>
