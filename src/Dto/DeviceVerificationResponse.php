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
 * File containing the definition of DeviceVerificationResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/device/verification API.
 *
 * Authlete's `/api/device/verification` API returns JSON which can be mapped
 * to this class. The authorization server implementation should retrieve the
 * value of the `action` response parameter (which can be obtained by
 * `getAction()` method of this class) from the response and take the following
 * steps according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceVerificationAction::$VALID`, it means that the user code exists, has
 * not expired, and belongs to the service. The authorization server
 * implementation should interact with the end-user to ask whether she approves
 * or rejects the authorization request from the device.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceVerificationAction::$EXPIRED`, it means that the the user code has
 * expired. The authorization server implementation should tell the end-user
 * that the user code has expired and urge her to re-initiate a device flow.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceVerificationAction::$NOT_EXIST`, it means that the user code does not
 * exist. The authorization server implementation should tell the end-user that
 * the user code is invalid and urge her to retry to input a valid user code.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceVerificationAction::$SERVER_ERROR`, it means that an error occurred
 * on Authlete side. The authorization server implementation should tell the
 * end-user that something wrong happened and urge her to re-initiate a device
 * flow.
 *
 * @since 1.8
 */
class DeviceVerificationResponse extends ApiResponse
{
    private ?DeviceVerificationAction $action = null;
    private string|int|null $clientId         = null;
    private ?string $clientIdAlias            = null;
    private bool $clientIdAliasUsed           = false;
    private ?string $clientName               = null;
    private ?array $scopes                    = null;
    private ?array $claimNames                = null;
    private ?array $acrs                      = null;
    private string|int|null $expiresAt        = null;
    private ?array $resources                 = null;


    /**
     * Get the next action that the authorization server should take.
     *
     * @return DeviceVerificationAction|null
     *     The next action that the authorization server should take.
     */
    public function getAction(): ?DeviceVerificationAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the authorization server should take.
     *
     * @param DeviceVerificationAction|null $action
     *     The next action that the authorization server should take.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setAction(DeviceVerificationAction $action = null): DeviceVerificationResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the ID of the client application to which the user code has been
     * issued.
     *
     * @return int|string|null
     *     The client ID.
     */
    public function getClientId(): int|string|null
    {
        return $this->clientId;
    }


    /**
     * Set the ID of the client application to which the user code has been
     * issued.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setClientId(int|string $clientId): DeviceVerificationResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client ID alias of the client application to which the user code
     * has been issued.
     *
     * @return string|null
     *     The client ID alias.
     */
    public function getClientIdAlias(): ?string
    {
        return $this->clientIdAlias;
    }


    /**
     * Set the client ID alias of the client application to which the user code
     * has been issued.
     *
     * @param string $alias
     *     The client ID alias.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setClientIdAlias(string $alias): DeviceVerificationResponse
    {
        ValidationUtility::ensureNullOrString('$alias', $alias);

        $this->clientIdAlias = $alias;

        return $this;
    }


    /**
     * Get the flag which indicates whether the client ID alias was used in
     * the device authorization request for the user code.
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
     * the device authorization request for the user code.
     *
     * @param boolean $used
     *     `true` to indicate that the client ID alias was used in the request.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setClientIdAliasUsed(bool $used): DeviceVerificationResponse
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the name of the client application to which the user code has been
     * issued.
     *
     * @return string|null
     *     The name of the client application.
     */
    public function getClientName(): ?string
    {
        return $this->clientName;
    }


    /**
     * Set the name of the client application to which the user code has been
     * issued.
     *
     * @param string $name
     *     The name of the client application.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setClientName(string $name): DeviceVerificationResponse
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->clientName = $name;

        return $this;
    }


    /**
     * Get the scopes requested by the device authorization request for the
     * user code.
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
     * Set the scopes requested by the device authorization request for the
     * user code.
     *
     * @param Scope[] $scopes
     *     The requested scopes.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): DeviceVerificationResponse
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
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setClaimNames(array $names = null): DeviceVerificationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$names', $names);

        $this->claimNames = $names;

        return $this;
    }


    /**
     * Get the list of ACR values requestsed by the device authorization
     * request.
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
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setAcrs(array $acrs = null): DeviceVerificationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$acrs', $acrs);

        $this->acrs = $acrs;

        return $this;
    }


    /**
     * Get the date in milliseconds since the Unix epoch (1970-Jan-01) at
     * which the user code will expire.
     *
     * @return int|string|null
     *     The expiration date in milliseconds since the Unix epoch
     *     (1970-Jan-01) at which the user code will expire.
     */
    public function getExpiresAt(): int|string|null
    {
        return $this->expiresAt;
    }


    /**
     * Set the date in milliseconds since the Unix epoch (1970-Jan-01) at
     * which the user code will expire.
     *
     * @param integer|string $expiresAt
     *     The expiration date in milliseconds since the Unix epoch
     *     (1970-Jan-01) at which the user code will expire.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setExpiresAt(int|string $expiresAt): DeviceVerificationResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->expiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the resources specified by the `resource` request parameters in the
     * preceding device authorization request.
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
     * Set the resources specified by the `resource` request parameters in the
     * preceding device authorization request.
     *
     * @param string[] $resources
     *     The target resources.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8707.html RFC 8707 Resource Indicators for OAuth 2.0
     */
    public function setResources(array $resources = null): DeviceVerificationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$resources', $resources);

        $this->resources = $resources;

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

        $array['action']            = LanguageUtility::toString($this->action);
        $array['clientId']          = $this->clientId;
        $array['clientIdAlias']     = $this->clientIdAlias;
        $array['clientIdAliasUsed'] = $this->clientIdAliasUsed;
        $array['clientName']        = $this->clientName;
        $array['scopes']            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->scopes);
        $array['claimNames']        = $this->claimNames;
        $array['acrs']              = $this->acrs;
        $array['expiresAt']         = $this->expiresAt;
        $array['resources']         = $this->resources;
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
            DeviceVerificationAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

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

        // expiresAt
        $this->setExpiresAt(
            LanguageUtility::getFromArray('expiresAt', $array));

        // resources
        $_resources = LanguageUtility::getFromArray('resources', $array);
        $this->setResources($_resources);
    }
}
