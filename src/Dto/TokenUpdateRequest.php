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
 * File containing the definition of TokenUpdateRequest class.
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
 * Request to Authlete's /api/auth/token/update API.
 */
class TokenUpdateRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string         $accessToken                              = null;
    private string|int|null $accessTokenExpiresAt                     = null;
    private ?array          $scopes                                   = null;  // array of string
    private ?array          $properties                               = null;  // array of \Authlete\Dto\Property
    private bool            $accessTokenExpiresAtUpdatedOnScopeUpdate = false;
    private bool            $accessTokenPersistent                    = false;
    private ?string         $accessTokenHash                          = null;
    private bool            $accessTokenValueUpdated                  = false;
    private ?string         $certificateThumbprint                    = null;
    private ?string         $dpopKeyThumbprint                        = null;


    /**
     * Get the access token to be updated.
     *
     * @return string|null
     *     The access token.
     */
    public function getAccessToken(): ?string
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
    public function setAccessToken(string $accessToken): TokenUpdateRequest
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the new date at which the acces token will expire.
     *
     * @return int|string|null
     *     The new date at which the access token will expire.
     */
    public function getAccessTokenExpiresAt(): int|string|null
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
    public function setAccessTokenExpiresAt(int|string $expiresAt): TokenUpdateRequest
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->accessTokenExpiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the new set of scopes assigned to the access token.
     *
     * @return array|null
     *     The new set of scopes assigned to the access token.
     */
    public function getScopes(): ?array
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
    public function setScopes(array $scopes = null): TokenUpdateRequest
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the new set of properties assigned to the access token.
     *
     * @return string[]|null
     *     The new set of properties assigned to the access token.
     */
    public function getProperties(): ?array
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
    public function setProperties(array $properties = null): TokenUpdateRequest
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get the flag which indicates whether `/api/auth/token/update` API
     * attempts to update the expiration date of the access token when the
     * scopes linked to the access token are changed by this request.
     *
     * @return boolean
     *     `true` if the expiration date of the access token is updated
     *     as necessary when scopes are updated.
     *
     * @since 1.8
     */
    public function isAccessTokenExpiresAtUpdatedOnScopeUpdate(): bool
    {
        return $this->accessTokenExpiresAtUpdatedOnScopeUpdate;
    }


    /**
     * Set the flag which indicates whether `/api/auth/token/update` API
     * attempts to update the expiration date of the access token when the
     * scopes linked to the access token are changed by this request.
     *
     * This request parameter is optional and its default value is `false`.
     * If this request parameter is set to `true` and all of the following
     * conditions are satisfied, the API performs an update on the expiration
     * date of the access token even if the `accessTokenExpiresAt` request
     * parameter is not explicitly specified in the request.
     *
     * 1. The `accessTokenExpiresAt` request parameter is not included in the
     *    request or its value is 0 (or negative).
     *
     * 2. The scopes linked to the access token are changed by the `scopes`
     *    request parameter in the request.
     *
     * 3. Any of the new scopes to be linked to the access token has one or
     *    more attributes specifying access token duration.
     *
     * When multiple access token duration values are found in the attributes
     * of the specified scopes, the smallest value among them is used.
     *
     * @param boolean $updated
     *     `true` to update the expiration date of the access token when the
     *     scopes linked to the access token are changed by this request.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenExpiresAtUpdatedOnScopeUpdate(bool $updated): TokenUpdateRequest
    {
        ValidationUtility::ensureBoolean('$updated', $updated);

        $this->accessTokenExpiresAtUpdatedOnScopeUpdate = $updated;

        return $this;
    }


    /**
     * Get whether the access token expires or not. By default, all access
     * tokens expire after a period of time determined by their service.
     * If this request parameter is `true` then the access token will not
     * automatically expire.
     *
     * If this request parameter is `true`, the `accessTokenDuration` request
     * parameter is ignored.
     *
     * @return boolean
     *     `false` if the access token expires (default).
     *     `true` if the access token does not expire.
     *
     * @since 1.8
     */
    public function isAccessTokenPersistent(): bool
    {
        return $this->accessTokenPersistent;
    }


    /**
     * Get whether the access token expires or not. By default, all access
     * tokens expire after a period of time determined by their service.
     * If this request parameter is `true` then the access token will not
     * automatically expire.
     *
     * If this request parameter is `true`, the `accessTokenDuration` request
     * parameter is ignored.
     *
     * @param boolean $persistent
     *     `false` to make the access token expire (default).
     *     `true` to make the access token be persistent.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenPersistent(bool $persistent): TokenUpdateRequest
    {
        ValidationUtility::ensureBoolean('$persistent', $persistent);

        $this->accessTokenPersistent = $persistent;

        return $this;
    }


    /**
     * Get the hash of the the access token value. Used when the hash of the
     * token is known (perhaps from lookup) but the value of the token itself
     * is not.
     *
     * @return string|null
     *     The hash of the access token value.
     *
     * @since 1.8
     */
    public function getAccessTokenHash(): ?string
    {
        return $this->accessTokenHash;
    }


    /**
     * Set the hash of the the access token value. Used when the hash of the
     * token is known (perhaps from lookup) but the value of the token itself
     * is not.
     *
     * @param string $hash
     *     The hash of the access token value.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenHash(string $hash): TokenUpdateRequest
    {
        ValidationUtility::ensureNullOrString('$hash', $hash);

        $this->accessTokenHash = $hash;

        return $this;
    }


    /**
     * Get whether to update the value of the access token in the data store.
     * If this parameter is set to `true` then a new access token value is
     * generated by the server and returned in the response.
     *
     * @return boolean
     *     `false` to keep the access token's current value (default).
     *     `true` to have the server update the access token's value.
     *
     * @since 1.8
     */
    public function isAccessTokenValueUpdated(): bool
    {
        return $this->accessTokenValueUpdated;
    }


    /**
     * Set whether to update the value of the access token in the data store.
     * If this parameter is set to `true` then a new access token value is
     * generated by the server and returned in the response.
     *
     * @param boolean $updated
     *     `false` to keep the access token's current value (default).
     *     `true` to have the server update the access token's value.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenValueUpdated(bool $updated): TokenUpdateRequest
    {
        ValidationUtility::ensureBoolean('$updated', $updated);

        $this->accessTokenValueUpdated = $updated;

        return $this;
    }


    /**
     * Get the thumbprint of the client certificate bound to the access token.
     * If this request parameter is set, a certificate whose thumbprint matches
     * the value must be presented when the client uses the access token.
     *
     * @return string|null
     *     The base64url-encoded SHA-256 certificate thumbprint.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getCertificateThumbprint(): ?string
    {
        return $this->certificateThumbprint;
    }


    /**
     * Set the thumbprint of the client certificate bound to the access token.
     * If this request parameter is set, a certificate whose thumbprint matches
     * the value must be presented when the client uses the access token.
     *
     * @param string $thumbprint
     *     The base64url-encoded SHA-256 certificate thumbprint.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function setCertificateThumbprint(string $thumbprint): TokenUpdateRequest
    {
        ValidationUtility::ensureNullOrString('$thumbprint', $thumbprint);

        $this->certificateThumbprint = $thumbprint;

        return $this;
    }


    /**
     * Get the thumbprint of the public key used for DPoP presentation of this
     * access token. If this request parameter is set, a DPoP proof signed with
     * the corresponding private key must be presented when the client uses the
     * access token.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string|null
     *     The JWK publick key thumbprint.
     *
     * @since 1.8
     */
    public function getDpopKeyThumbprint(): ?string
    {
        return $this->dpopKeyThumbprint;
    }


    /**
     * Set the thumbprint of the public key used for DPoP presentation of this
     * access token. If this request parameter is set, a DPoP proof signed with
     * the corresponding private key must be presented when the client uses the
     * access token.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $thumbprint
     *     The JWK publick key thumbprint.
     *
     * @return TokenUpdateRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setDpopKeyThumbprint(string $thumbprint): TokenUpdateRequest
    {
        ValidationUtility::ensureNullOrString('$thumbprint', $thumbprint);

        $this->dpopKeyThumbprint = $thumbprint;

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
        $array['accessToken']                              = $this->accessToken;
        $array['accessTokenExpiresAt']                     = LanguageUtility::orZero($this->accessTokenExpiresAt);
        $array['scopes']                                   = $this->scopes;
        $array['properties']                               = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['accessTokenExpiresAtUpdatedOnScopeUpdate'] = $this->accessTokenExpiresAtUpdatedOnScopeUpdate;
        $array['accessTokenPersistent']                    = $this->accessTokenPersistent;
        $array['accessTokenHash']                          = $this->accessTokenHash;
        $array['accessTokenValueUpdated']                  = $this->accessTokenValueUpdated;
        $array['certificateThumbprint']                    = $this->certificateThumbprint;
        $array['dpopKeyThumbprint']                        = $this->dpopKeyThumbprint;
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
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);

        // accessTokenExpiresAtUpdatedOnScopeUpdate
        $this->setAccessTokenExpiresAtUpdatedOnScopeUpdate(
            LanguageUtility::getFromArrayAsBoolean('accessTokenExpiresAtUpdatedOnScopeUpdate', $array));

        // accessTokenPersistent
        $this->setAccessTokenPersistent(
            LanguageUtility::getFromArrayAsBoolean('accessTokenPersistent', $array));

        // accessTokenHash
        $this->setAccessTokenHash(
            LanguageUtility::getFromArray('accessTokenHash', $array));

        // accessTokenValueUpdated
        $this->setAccessTokenValueUpdated(
            LanguageUtility::getFromArrayAsBoolean('accessTokenValueUpdated', $array));

        // certificateThumbprint
        $this->setCertificateThumbprint(
            LanguageUtility::getFromArray('certificateThumbprint', $array));

        // dpopKeyThumbprint
        $this->setDpopKeyThumbprint(
            LanguageUtility::getFromArray('dpopKeyThumbprint', $array));
    }
}

