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
 * File containing the definition of TokenUpdateResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/token/update API.
 *
 * Authlete's `/api/auth/token/update` API returns JSON which can be mapped
 * to this class. The first step that a caller should take is to retrieve
 * the value of the `action` response parameter (which can be obtained by
 * `getAction()` method) from the response.
 *
 * When the value returned from `getAction()` method is
 * `TokenUpdateAction::$INTERNAL_SERVER_ERROR`, it means that an error
 * occurred on Authlete side.
 *
 * When the value returned from `getAction()` method is
 * `TokenUpdateAction::$BAD_REQUEST`, it means that the request from the
 * caller was wrong. For example, this happens when the `accessToken` request
 * parameter is missing.
 *
 * When the value returned from `getAction()` method is
 * `TokenUpdateAction::$FORBIDDEN`, it means that the request from the caller
 * was not allowed. For example, this happens when the access token identified
 * by the `accessToken` request parameter does not belong to the service
 * identified by the API key used for the API call.
 *
 * When the value returned from `getAction()` method is
 * `TokenUpdateAction::$NOT_FOUND`, it means that the specified access token
 * does not exist.
 *
 * When the value returned from `getAction()` method is
 * `TokenUpdateAction::$OK`, it means that the access token was updated
 * successfully.
 */
class TokenUpdateResponse extends ApiResponse
{
    private $action               = null;  // \Authlete\Dto\TokenUpdateAction
    private $accessToken          = null;  // string
    private $accessTokenExpiresAt = null;  // string or (64-bit) integer
    private $scopes               = null;  // array of string
    private $properties           = null;  // array of \Authlete\Dto\Property


    /**
     * Get the code which indicates how the response should be interpreted.
     *
     * @return TokenUpdateAction
     *     The code which indicates how the response should be interpreted.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the code which indicates how the response should be interpreted.
     *
     * @param TokenUpdateAction $action
     *     The code which indicates how the response should be interpreted.
     *
     * @return TokenUpdateResponse
     *     `$this` object.
     */
    public function setAction(TokenUpdateAction $action = null)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the access token which was specified by the "accessToken" request
     * parameter of the API call.
     *
     * @return string
     *     The access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the access token which was specified by the "accessToken" request
     * parameter of the API call.
     *
     * @param string $accessToken
     *     The access token.
     *
     * @return TokenUpdateResponse
     *     `$this` object.
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
     * The value is expressed in milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return integer|string
     *     The date at which the access token will expire.
     */
    public function getAccessTokenExpiresAt()
    {
        return $this->accessTokenExpiresAt;
    }


    /**
     * Set the date at which the access token will expire.
     *
     * @param integer|string $expiresAt
     *     The date at which the access token will expire. The value should be
     *     expressed in milliseconds since the Unix epoch (1970-Jan-1).
     *
     * @return integer|string
     *     `$this` object.
     */
    public function setAccessTokenExpiresAt($expiresAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->accessTokenExpiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the scopes associated with the access token.
     *
     * @return string[]
     *     The scopes associated with the access token.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set the scopes associated with the access token.
     *
     * @param string[] $scopes
     *     The scopes associated with the access token.
     *
     * @return TokenUpdateResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
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
    public function getProperties()
    {
        return $this->properties;
    }


    /**
     * Set the properties associated with the access token.
     *
     * @param Property[] $properties
     *     The properties associated with the access token.
     *
     * @return TokenUpdateResponse
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
        $array['accessToken']          = $this->accessToken;
        $array['accessTokenExpiresAt'] = LanguageUtility::orZero($this->accessTokenExpiresAt);
        $array['scopes']               = $this->scopes;
        $array['properties']           = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
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
            TokenUpdateAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // accessTokenExpiresAt
        $this->setAccessTokenExpiresAt(
            LanguageUtility::getFromArray('accessTokenExpiresAt', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable($_properties, __NAMESPACE__ . '\Property');
        $this->setProperties($_properties);
    }
}
?>
