<?php
//
// Copyright (C) 2020 Authlete, Inc.
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
    private $action            = null;  // \Authlete\Dto\DeviceVerificationAction
    private $clientId          = null;  // string or (64-bit) integer
    private $clientIdAlias     = null;  // string
    private $clientIdAliasUsed = false; // boolean
    private $clientName        = null;  // string
    private $scopes            = null;  // array of \Authlete\Dto\Scope
    private $claimNames        = null;  // array of string
    private $acrs              = null;  // array of string
    private $expiresAt         = null;  // string or (64-bit) integer
    private $resources         = null;  // array of string


    /**
     * Get the next action that the authorization server should take.
     *
     * @return DeviceVerificationAction
     *     The next action that the authorization server should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the authorization server should take.
     *
     * @param DeviceVerificationAction $action
     *     The next action that the authorization server should take.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setAction(DeviceVerificationAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the ID of the client application to which the user code has been
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
     * Set the ID of the client application to which the user code has been
     * issued.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setClientId($clientId)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the client ID alias of the client application to which the user code
     * has been issued.
     *
     * @return string
     *     The client ID alias.
     */
    public function getClientIdAlias()
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
    public function setClientIdAlias($alias)
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
    public function isClientIdAliasUsed()
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
    public function setClientIdAliasUsed($used)
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the name of the client application to which the user code has been
     * issued.
     *
     * @return string
     *     The name of the client application.
     */
    public function getClientName()
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
    public function setClientName($name)
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
     * @return Scope[]
     *     The requested scopes.
     */
    public function getScopes()
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
     * This method always returns `null` if the `scope` request parameter of
     * the device authorization request does not include the `openid` scope
     * even if special scopes (such as `profile`) are included in the request
     * (unless the `openid` scope is included in the default set of scopes
     * which is used when the `scope` request parameter is omitted).
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
     * @return DeviceVerificationResponse
     *     `$this` object.
     */
    public function setClaimNames(array $names = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$names', $names);

        $this->claimNames = $names;

        return $this;
    }


    /**
     * Get the list of ACR values requestsed by the device authorization
     * request.
     *
     * @return string[]
     *     The list of requested ACR values.
     */
    public function getAcrs()
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
    public function setAcrs(array $acrs = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$acrs', $acrs);

        $this->acrs = $acrs;

        return $this;
    }


    /**
     * Get the date in milliseconds since the Unix epoch (1970-Jan-01) at
     * which the user code will expire.
     *
     * @return integer|string
     *     The expiration date in milliseconds since the Unix epoch
     *     (1970-Jan-01) at which the user code will expire.
     */
    public function getExpiresAt()
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
    public function setExpiresAt($expiresAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->expiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the resources specified by the `resource` request parameters in the
     * preceding device authorization request.
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
    public function setResources(array $resources = null)
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
    public function copyToArray(array &$array)
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
    public function copyFromArray(array &$array)
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
        $scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $scopes, __NAMESPACE__ . '\Scope'));

        // claimNames
        $this->setClaimNames(
            LanguageUtility::getFromArray('claimNames', $array));

        // acrs
        $this->setAcrs(
            LanguageUtility::getFromArray('acrs', $array));

        // expiresAt
        $this->setExpiresAt(
            LanguageUtility::getFromArray('expiresAt', $array));

        // resources
        $this->setResources(
            LanguageUtility::getFromArray('resources', $array));
    }
}
?>
