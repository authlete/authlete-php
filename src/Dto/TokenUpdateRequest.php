<?php
//
// Copyright (C) 2018 Authlete, Inc.
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
 * File containing the definition of TokenUpdateRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/auth/token/update API.
 */
class TokenUpdateRequest implements ArrayCopyable, Jsonable
{
    use JsonTrait;


    private $accessToken          = null;  // string
    private $accessTokenExpiresAt = null;  // string or (64-bit) integer
    private $scopes               = null;  // array of string
    private $properties           = null;  // array of \Authlete\Dto\Property


    /**
     * Get the access token to be updated.
     *
     * @return string
     *     The access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the access token to be updated.
     *
     * @param string $accessToken
     *     The access token.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     */
    public function setAccessToken($accessToken)
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the new date at which the acces token will expire.
     *
     * @return integer|string
     *     The new date at which the access token will expire.
     */
    public function getAccessTokenExpiresAt()
    {
        return $this->accessTokenExpiresAt;
    }


    /**
     * Set the new date at which the acces token will expire.
     *
     * The value needs to be expressed in milliseconds since the Unix epoch
     * (1970-Jan-1). If 0 or a negative value is given, the expiration date
     * of the access token is not changed.
     *
     * @param integer|string $expiresAt
     *     The new date at which the access token will expire.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     */
    public function setAccessTokenExpiresAt($expiresAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->accessTokenExpiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the new set of scopes assigned to the access token.
     *
     * @return string[]
     *     The new set of scopes assigned to the access token.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set the new set of scopes assigned to the access token.
     *
     * If `null` is given, the scope set associated with the access token is
     * not changed.
     *
     * @param string[] $scopes
     *     The new set of scopes assigned to the access token.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the new set of properties assigned to the access token.
     *
     * @return Property[]
     *     The new set of properties assigned to the access token.
     */
    public function getProperties()
    {
        return $this->properties;
    }


    /**
     * Set the new set of properties assigned to the access token.
     *
     * If `null` is given, theproperty set associated with the access token
     * is not changed.
     *
     * @param Property[] $properties
     *     The new set of properties assigned to the access token.
     *
     * @return TokenUpdateRequest
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
        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // accessTokenExpiresAt
        $this->setAccessTokenExpiresAt(
            LanguageUtility::getFromArray('accessTokenExpiresAt', $array));

        // scopes
        $this->setScopes(
            LanguageUtility::getFromArray('scopes', $array));

        // properties
        $properties = LanguageUtility::getFromArray('properties', $array);
        $this->setProperties(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                $properties, __NAMESPACE__ . '\Property'));
    }
}
?>