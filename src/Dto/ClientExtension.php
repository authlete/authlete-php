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
 * File containing the definition of ClientExtension class.
 */


namespace Authlete\Dto;


use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
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
class ClientExtension implements ArrayCopyable, Jsonable
{
    use JsonTrait;


    private $requestableScopesEnabled = false; // boolean
    private $requestableScopes        = null;  // array of string


    /**
     * Get the flag which indicates whether the "Requestable Scopes per
     * Client" feature is enabled or not.
     *
     * @return boolean
     *     `true` if the "Requestable Scopes per Client" feature is enabled.
     */
    public function isRequestableScopesEnabled()
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
    public function setRequestableScopesEnabled($enabled)
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
     * @return string[]
     *      Scopes that the client application can request.
     */
    public function getRequestableScopes()
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
    public function setRequestableScopes(array $requestableScopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$requestableScopes', $requestableScopes);

        $this->requestableScopes = $requestableScopes;

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
        $array['requestableScopesEnabled'] = $this->requestableScopesEnabled;
        $array['requestableScopes']        = $this->requestableScopes;
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
        // requestableScopesEnabled
        $this->setRequestableScopesEnabled(
            LanguageUtility::getFromArrayAsBoolean('requestableScopesEnabled', $array));

        // requestableScopes
        $this->setRequestableScopes(
            LanguageUtility::getFromArray('requestableScopes', $array));
    }
}
?>