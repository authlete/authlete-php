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
 * File containing the definition of ClientExtension class.
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
 * Extended information about a client application.
 *
 * There are some attributes that belong to a client application but should
 * not be changed by the developer of the client application. This class
 * holds such attributes.
 *
 * For example, an authorization server may narrow the range of scopes
 * (permissions) that a particular client application can request. In this
 * case, it is meaningless if the developer of the client application can
 * freely decide the set of requestable scopes. It is not the developer of
 * the client application but the administrator of the authorization server
 * that should be allowed to define the set of scopes that the client
 * application can request.
 */
class ClientExtension implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private bool $requestableScopesEnabled            = false;
    private ?array $requestableScopes                 = null;  // array of string
    private string|int|null $accessTokenDuration      = null;
    private string|int|null $refreshTokenDuration     = null;


    /**
     * Get the flag which indicates whether the "Requestable Scopes per
     * Client" feature is enabled or not.
     *
     * @return boolean
     *     `true` if the "Requestable Scopes per Client" feature is enabled.
     */
    public function isRequestableScopesEnabled(): bool
    {
        return $this->requestableScopesEnabled;
    }


    /**
     * Set the flag which indicates whether the "Requestable Scopes per
     * Client" feature is enabled or not.
     *
     * If `true` is set, a special set of scopes (permissions) is defined on
     * the server side (`getRequestableScopes()` method returns the special
     * set) and scopes which the client application can request are limited
     * to the scopes listed in the special set. In other words, the
     * application cannot request scopes that are not included in the special
     * set. To be specific, the client application cannot list other scopes
     * in the `scope` request parameter when it makes an authorization
     * request. To be exact, other scopes can be listed but will be ignored
     * by the authorization server.
     *
     * On the other hand, `false` is set, the valid set of scopes
     * (permissions) that the client application can request is equal to the
     * whole scope set defined by the authorization server.
     *
     * @param boolean $enabled
     *     `true` if the "Requestable Scopes per Client" feature is enabled.
     *
     * @return ClientExtension
     *     `$this` object.
     */
    public function setRequestableScopesEnabled(bool $enabled): ClientExtension
    {
        ValidationUtility::ensureBoolean('$enabled', $enabled);

        $this->requestableScopesEnabled = $enabled;

        return $this;
    }


    /**
     * Get the set of scopes that the client application can request when
     * the "Requestable Scopes per Client" feature is enabled (= when the
     * `isRequestableScopesEnabled()` method returns `true`).
     *
     * @return string[]|null
     *      Scopes that the client application can request.
     */
    public function getRequestableScopes(): ?array
    {
        return $this->requestableScopes;
    }


    /**
     * Set the set of scopes that the client application can request when
     * the "Requestable Scopes per Client" feature is enabled (= when the
     * `isRequestableScopesEnabled()` method returns `true`).
     *
     * @param string[] $requestableScopes
     *     Scopes that the client application can request.
     *
     * @return ClientExtension
     *     `$this` object.
     */
    public function setRequestableScopes(array $requestableScopes = null): ClientExtension
    {
        ValidationUtility::ensureNullOrArrayOfString('$requestableScopes', $requestableScopes);

        $this->requestableScopes = $requestableScopes;

        return $this;
    }


    /**
     * Get the duration of access tokens per client in seconds.
     *
     * In normal cases, the values of the Service's `accessTokenDuration`
     * property is used as the duration of access tokens issued by the
     * service. However, if this `accessTokenDuration` property holds a
     * non-zero positive number and its value is less than the duration
     * configured by the service, the value is used as the duration of
     * access tokens issued to the client application.
     *
     * Note that the duration of access tokens can be controlled by the
     * scope attribute `access_token.duration`, too. Authlete chooses the
     * minimum value among the candidates.
     *
     * @return integer|string|null
     *     The duration of access tokens per client in seconds.
     *
     * @since 1.8
     */
    public function getAccessTokenDuration(): int|string|null
    {
        return $this->accessTokenDuration;
    }


    /**
     * Set the duration of access tokens per client in seconds.
     *
     * In normal cases, the values of the Service's `accessTokenDuration`
     * property is used as the duration of access tokens issued by the
     * service. However, if this `accessTokenDuration` property holds a
     * non-zero positive number and its value is less than the duration
     * configured by the service, the value is used as the duration of
     * access tokens issued to the client application.
     *
     * Note that the duration of access tokens can be controlled by the
     * scope attribute `access_token.duration`, too. Authlete chooses the
     * minimum value among the candidates.
     *
     * @param integer|string $duration
     *     The duration of access tokens per client in seconds.
     *
     * @return ClientExtension
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenDuration(int|string $duration): ClientExtension
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of refresh tokens per client in seconds.
     *
     * In normal cases, the values of the Service's `refreshTokenDuration`
     * property is used as the duration of refresh tokens issued by the
     * service. However, if this `refreshTokenDuration` property holds a
     * non-zero positive number and its value is less than the duration
     * configured by the service, the value is used as the duration of
     * refresh tokens issued to the client application.
     *
     * Note that the duration of refresh tokens can be controlled by the
     * scope attribute `refresh_token.duration`, too. Authlete chooses the
     * minimum value among the candidates.
     *
     * @return int|string|null
     *     The duration of refresh tokens per client in seconds.
     *
     * @since 1.8
     */
    public function getRefreshTokenDuration(): int|string|null
    {
        return $this->refreshTokenDuration;
    }


    /**
     * Set the duration of refresh tokens per client in seconds.
     *
     * In normal cases, the values of the Service's `refreshTokenDuration`
     * property is used as the duration of refresh tokens issued by the
     * service. However, if this `refreshTokenDuration` property holds a
     * non-zero positive number and its value is less than the duration
     * configured by the service, the value is used as the duration of
     * refresh tokens issued to the client application.
     *
     * Note that the duration of refresh tokens can be controlled by the
     * scope attribute `refresh_token.duration`, too. Authlete chooses the
     * minimum value among the candidates.
     *
     * @param integer|string $duration
     *     The duration of refresh tokens per client in seconds.
     *
     * @return ClientExtension
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setRefreshTokenDuration(int|string $duration): ClientExtension
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->refreshTokenDuration = $duration;

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
        $array['requestableScopesEnabled'] = $this->requestableScopesEnabled;
        $array['requestableScopes']        = $this->requestableScopes;
        $array['accessTokenDuration']      = $this->accessTokenDuration;
        $array['refreshTokenDuration']     = $this->refreshTokenDuration;
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
        // requestableScopesEnabled
        $this->setRequestableScopesEnabled(
            LanguageUtility::getFromArrayAsBoolean('requestableScopesEnabled', $array));

        // requestableScopes
        $_requestable_scopes = LanguageUtility::getFromArray('requestableScopes', $array);
        $this->setRequestableScopes($_requestable_scopes);

        // accessTokenDuration
        $this->setAccessTokenDuration(
            LanguageUtility::getFromArray('accessTokenDuration', $array));

        // refreshTokenDuration
        $this->setRefreshTokenDuration(
            LanguageUtility::getFromArray('refreshTokenDuration', $array));
    }
}
