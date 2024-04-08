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
 * File containing the definition of DeviceAuthorizationResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/device/authorization API.
 *
 * Authlete's `/api/device/authorization` API returns JSON which can be mapped
 * to this class. The authorization server implementation should retrieve the
 * value of the `action` response parameter (which can be obtained by
 * `getAction()` method of this class) from the response and take the following
 * steps according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceAuthorizationAction::$OK`, it means that the device authorization
 * request from the client application is valid.
 *
 * The authorization server implementation should generate a response to the
 * client application with `200 OK` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which can be used
 * as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 200 OK
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
 * `DeviceAuthorizationAction::$BAD_REQUEST`, it means that the device
 * authorization request from the client application was wrong.
 *
 * The authorization server implementation should generate a response to the
 * client application with `400 Bad Request` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes
 * the error, so it can be used as the entity body of the response.
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
 * `DeviceAuthorizationAction::$UNAUTHORIZED`, it means that client
 * authentication of the device authorization request failed.
 *
 * The authorization server implementation should generate a response to the
 * client application with `401 Unauthorized` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes
 * the error, so it can be used as the entity body of the response.
 *
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 401 Unauthorized
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
 * `DeviceAuthorizationAction::$INTERNAL_SERVER_ERROR`, it means that the API
 * call from the authorization server implementation was wrong or that an error
 * occurred in Authlete.
 *
 * In either case, from a viewpoint of the client application, it is an error
 * on the server side. Therefore, the authorization server implementation
 * should generate a response to the client application with
 * `500 Internal Server Error` and `application/json`.
 *
 * The `getResponseContent()` method returns a JSON string which describes
 * the error, so it can be used as the entity body of the response.
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
 * @since 1.8
 */
class DeviceAuthorizationResponse extends ApiResponse
{
    private ?DeviceAuthorizationAction $action = null;
    private ?string $responseContent           = null;
    private string|int|null $clientId          = null;
    private ?string $clientIdAlias             = null;
    private bool $clientIdAliasUsed            = false;
    private ?string $clientName                = null;
    private ?array $scopes                     = null;  // array of \Authlete\Dto\Scope
    private ?array $claimNames                 = null;  // array of string
    private ?array $acrs                       = null;  // array of string
    private ?string $deviceCode                = null;
    private ?string $userCode                  = null;
    private ?string $verificationUri           = null;
    private ?string $verificationUriComplete   = null;
    private string|int|null $expiresIn         = null;
    private int $interval                      = 0;
    private ?array $resources                  = null;  // array of string
    private ?array $warnings                   = null;  // array of string


    /**
     * Get the next action that the device authorization endpoint should take.
     *
     * @return DeviceAuthorizationAction|null
     *     The next action that the device authorization endpoint should take.
     */
    public function getAction(): ?DeviceAuthorizationAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the device authorization endpoint should take.
     *
     * @param DeviceAuthorizationAction|null $action
     *     The next action that the device authorization endpoint should take.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setAction(DeviceAuthorizationAction $action = null): DeviceAuthorizationResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the content that can be used to generate a response to the client
     * application.
     *
     * @return string|null
     *     The response content.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the content that can be used to generate a response to the client
     * application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the ID of the client application that has made the device
     * authorization request.
     *
     * @return int|string|null
     *     The client ID.
     */
    public function getClientId(): int|string|null
    {
        return $this->clientId;
    }


    /**
     * Set the ID of the client application that has made the device
     * authorization request.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setClientId(int|string $clientId): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client ID alias of the client application that has made the
     * device authorization request.
     *
     * @return string|null
     *     The client ID alias.
     */
    public function getClientIdAlias(): ?string
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the client ID alias of the client application that has made the
     * device authorization request.
     *
     * @param string $alias
     *     The client ID alias.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setClientIdAlias(string $alias): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias was used in
     * the device authorization request.
     *
     * @return boolean
     *     `true` if the client ID alias was used in the request.
     */
    public function isClientIdAliasUsed(): bool
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether the client ID alias was used in
     * the device authorization request.
     *
     * @param boolean $used
     *     `true` to indicate that the client ID alias was used in the request.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setClientIdAliasUsed(bool $used): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the name of the client application that has made the device
     * authorization request.
     *
     * @return string|null
     *     The name of the client application.
     */
    public function getClientName(): ?string
    {
        return $this->clientName;
    }


    /**
     * Set the name of the client application that has made the device
     * authorization request.
     *
     * @param string $name
     *     The name of the client application.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setClientName(string $name): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->clientName = $name;

        return $this;
    }


    /**
     * Get the scopes requested by the device authorization request.
     *
     * Basically, this method returns the value of the `scope` request parameter
     * in the device authorization request. However, because unregistered
     * scopes are dropped on Authlete side, if the `scope` request parameter
     * contains unknown scopes, the list returned by this method becomes
     * different from the value of the `scope` request parameter.
     *
     * Note that `Scope.getDescription()` method and `Scope.getDescriptions()`
     * method of each element (`Scope` instance) in the array returned from
     * this method always return `null` even if descriptions of the scopes are
     * registered.
     *
     * @return array|null
     *     The requested scopes.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set the scopes requested by the device authorization request.
     *
     * @param Scope[] $scopes
     *     The requested scopes.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$scopes', __NAMESPACE__ . '\Scope', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the names of the claims which were requested indirectly via some
     * special scopes. See [5.4. Requesting Claims using Scope Values](https://openid.net/specs/openid-connect-core-1_0.html#ScopeClaims)
     * in [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html#ScopeClaims)
     * for details.
     *
     * This method always returns `null` if the `scope` request parameter of
     * the device authorization request does not include the `openid` scope
     * even if special scopes (such as `profile`) are included in the request
     * (unless the `openid` scope is included in the default set of scopes
     * which is used when the `scope` request parameter is omitted).
     *
     * @return array|null
     *     The names of the requested claims.
     */
    public function getClaimNames(): ?array
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
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setClaimNames(array $names = null): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$names', $names);

        $this->claimNames = $names;

        return $this;
    }


    /**
     * Get the list of ACR values requestsed by the device authorization
     * request.
     *
     * Basically, this method returns the value of the `acr_values` request
     * parameter in the device authorization request. However, because
     * unsupported ACR values are dropped on Authlete side, if the `acr_values`
     * request parameter contains unrecognized ACR values, the list returned
     * by this method becomes different from the value of the `acr_values`
     * request parameter.
     *
     * If the request does not include the `acr_values` request parameter,
     * the value of the `default_acr_values` client metadata is used.
     *
     * @return array|null
     *     The list of requested ACR values.
     */
    public function getAcrs(): ?array
    {
        return $this->acrs;
    }


    /**
     * Set the list of ACR values requestsed by the device authorization
     * request.
     *
     * @param string[] $acrs
     *     The list of requested ACR values.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setAcrs(array $acrs = null): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$acrs', $acrs);

        $this->acrs = $acrs;

        return $this;
    }


    /**
     * Get the device verification code. This corresponds to the `device_code`
     * property in the response to the client.
     *
     * @return string|null
     *     The device verification code.
     */
    public function getDeviceCode(): ?string
    {
        return $this->deviceCode;
    }


    /**
     * Set the device verification code. This corresponds to the `device_code`
     * property in the response to the client.
     *
     * @param string $code
     *     The device verification code.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setDeviceCode(string $code): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$code', $code);

        $this->deviceCode = $code;

        return $this;
    }


    /**
     * Get the end-user verification code. This corresponds to the
     * `user_code` property in the response to the client.
     *
     * @return string|null
     *     The end-user verification code.
     */
    public function getUserCode(): ?string
    {
        return $this->userCode;
    }


    /**
     * Set the end-user verification code. This corresponds to the
     * `user_code` property in the response to the client.
     *
     * @param string $code
     *     The end-user verification code.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setUserCode(string $code): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$code', $code);

        $this->userCode = $code;

        return $this;
    }


    /**
     * Get the end-user verification URI. This corresponds to the
     * `verification_uri` property in the response to the client.
     *
     * @return string|null
     *     The end-user verification URI.
     */
    public function getVerificationUri(): ?string
    {
        return $this->verificationUri;
    }


    /**
     * Set the end-user verification URI. This corresponds to the
     * `verification_uri` property in the response to the client.
     *
     * @param string $uri
     *     The end-user verification URI.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setVerificationUri(string $uri): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->verificationUri = $uri;

        return $this;
    }


    /**
     * Get the end-user verification URI that includes the end-user
     * verification code. This corresponds to the `verification_uri_complete`
     * property in the response to the client.
     *
     * @return string|null
     *     The end-user verification URI that includes the end-user
     *     verification code.
     */
    public function getVerificationUriComplete(): ?string
    {
        return $this->verificationUriComplete;
    }


    /**
     * Set the end-user verification URI that includes the end-user
     * verification code. This corresponds to the `verification_uri_complete`
     * property in the response to the client.
     *
     * @param string $uri
     *     The end-user verification URI that includes the end-user
     *     verification code.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setVerificationUriComplete(string $uri): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->verificationUriComplete = $uri;

        return $this;
    }


    /**
     * Get the duration of the issued device verification code and end-user
     * verification code in seconds. This corresponds to the `expires_in`
     * property in the response to the client.
     *
     * @return int|string|null
     *     The duration of the issued device verification code and end-user
     *     verification code in seconds.
     */
    public function getExpiresIn(): int|string|null
    {
        return $this->expiresIn;
    }


    /**
     * Set the duration of the issued device verification code and end-user
     * verification code in seconds. This corresponds to the `expires_in`
     * property in the response to the client.
     *
     * @param integer|string $expiresIn
     *     The duration of the issued device verification code and end-user
     *     verification code in seconds.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setExpiresIn(int|string $expiresIn): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresIn', $expiresIn);

        $this->expiresIn = $expiresIn;

        return $this;
    }


    /**
     * Get the minimum amount of time in seconds that the client must wait for
     * between polling requests to the token endpoint. This corresponds to the
     * `interval` property in the response to the client.
     *
     * @return integer
     *     The minimum amount of time in seconds between polling requests.
     */
    public function getInterval(): int
    {
        return $this->interval;
    }


    /**
     * Set the minimum amount of time in seconds that the client must wait for
     * between polling requests to the token endpoint. This corresponds to the
     * `interval` property in the response to the client.
     *
     * @param integer $interval
     *     The minimum amount of time in seconds between polling requests.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setInterval(int $interval): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureInteger('$interval', $interval);

        $this->interval = $interval;

        return $this;
    }


    /**
     * Get the resources specified by the `resource` request parameters.
     *
     * @return array|null
     *     The target resources.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     */
    public function getResources(): ?array
    {
        return $this->resources;
    }


    /**
     * Set the resources specified by the `resource` request parameters.
     *
     * @param string[] $resources
     *     The target resources.
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     */
    public function setResources(array $resources = null): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$resources', $resources);

        $this->resources = $resources;

        return $this;
    }


    /**
     * Get the warnings raised during processing the device authorization
     * request.
     *
     * @return array|null
     *     Warnings. This may be null.
     */
    public function getWarnings(): ?array
    {
        return $this->warnings;
    }


    /**
     * Set the warnings raised during processing the device authorization
     * request.
     *
     * @param string[] $warnings
     *     Warnings
     *
     * @return DeviceAuthorizationResponse
     *     `$this` object.
     */
    public function setWarnings(array $warnings = null): DeviceAuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$warnings', $warnings);

        $this->warnings = $warnings;

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

        $array['action']                  = LanguageUtility::toString($this->action);
        $array['responseContent']         = $this->responseContent;
        $array['clientId']                = $this->clientId;
        $array['clientIdAlias']           = $this->clientIdAlias;
        $array['clientIdAliasUsed']       = $this->clientIdAliasUsed;
        $array['clientName']              = $this->clientName;
        $array['scopes']                  = LanguageUtility::convertArrayOfArrayCopyableToArray($this->scopes);
        $array['claimNames']              = $this->claimNames;
        $array['acrs']                    = $this->acrs;
        $array['deviceCode']              = $this->deviceCode;
        $array['userCode']                = $this->userCode;
        $array['verificationUri']         = $this->verificationUri;
        $array['verificationUriComplete'] = $this->verificationUriComplete;
        $array['expiresIn']               = $this->expiresIn;
        $array['interval']                = $this->interval;
        $array['resources']               = $this->resources;
        $array['warnings']                = $this->warnings;
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
            DeviceAuthorizationAction::valueOf(
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

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $_scopes = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Scope', $_scopes);
        $this->setScopes($_scopes);

        // claimNames
        $_claim_names = LanguageUtility::getFromArray('claimNames', $array);
        $this->setClaimNames($_claim_names);

        // acrs
        $_acrs = LanguageUtility::getFromArray('acrs', $array);
        $this->setAcrs($_acrs);

        // deviceCode
        $this->setDeviceCode(
            LanguageUtility::getFromArray('deviceCode', $array));

        // userCode
        $this->setUserCode(
            LanguageUtility::getFromArray('userCode', $array));

        // verificationUri
        $this->setVerificationUri(
            LanguageUtility::getFromArray('verificationUri', $array));

        // verificationUriComplete
        $this->setVerificationUriComplete(
            LanguageUtility::getFromArray('verificationUriComplete', $array));

        // expiresIn
        $this->setExpiresIn(
            LanguageUtility::getFromArray('expiresIn', $array));

        // interval
        $this->setInterval(
            LanguageUtility::getFromArray('interval', $array));

        // resources
        $_resources = LanguageUtility::getFromArray('resources', $array);
        $this->setResources($_resources);

        // warnings
        $_warnings = LanguageUtility::getFromArray('warnings', $array);
        $this->setWarnings($_warnings);
    }
}

