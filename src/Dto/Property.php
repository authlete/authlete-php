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
 * File containing the definition of Property class.
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
 * A property associated with an access token and/or an authorization code.
 *
 * Some Authlete APIs accept a `properties` request parameter. The value of
 * the parameter is an array of \Authlete\Dto\Property.
 */
class Property implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $key;
    private ?string $value;
    private bool $hidden;


    /**
     * Constructor.
     *
     * @param string|null $key
     *     The name of this property.
     *
     * @param string|null $value
     *     The value of this property.
     *
     * @param boolean $hidden
     *     `true` to mark this property as hidden. Read the description of
     *     `setHidden($hidden)` for details.
     */
    public function __construct(string $key = null, string $value = null, bool $hidden = false)
    {
        ValidationUtility::ensureNullOrString('$key',    $key);
        ValidationUtility::ensureNullOrString('$value',  $value);
        ValidationUtility::ensureBoolean(     '$hidden', $hidden);

        $this->key    = $key;
        $this->value  = $value;
        $this->hidden = $hidden;
    }


    /**
     * Get the name of this property.
     *
     * @return string|null
     *     The name of this property.
     */
    public function getKey(): ?string
    {
        return $this->key;
    }


    /**
     * Set the name of this property.
     *
     * @param string $key
     *     The name of this property.
     *
     * @return Property
     *     `$this` object.
     */
    public function setKey(mixed $key): Property
    {
        ValidationUtility::ensureNullOrString('$key', $key);

        $this->key = $key;

        return $this;
    }


    /**
     * Get the value of this property.
     *
     * @return string|null
     *     The value of this property.
     */
    public function getValue(): ?string
    {
        return $this->value;
    }


    /**
     * Set the value of this property.
     *
     * @param string $value
     *     The value of this property.
     *
     * @return Property
     *     `$this` object.
     */
    public function setValue(mixed $value): Property
    {
        ValidationUtility::ensureNullOrString('$value', $value);

        $this->value = $value;

        return $this;
    }


    /**
     * Get the flag which indicates whether this property is hidden from the
     * client application or not.
     *
     * @return boolean
     *     `true` if this property is hidden from the client application.
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }


    /**
     * Set the flag which indicates whether this property is hidden from the
     * client application or not.
     *
     * If a property is not hidden, information about the property will be
     * sent back to the client application with an access token. For example,
     * if you set the `properties` request prameter as follows when you call
     * Authlete's `/api/auth/token` API,
     *
     * ```
     * "properties": [
     *   {
     *     "key":    "example_parameter",
     *     "value":  "example_value",
     *     "hidden": false
     *   }
     * ]
     * ```
     *
     * The value of the `responseContent` response parameter in the response
     * from the API will contain the pair of `example_parameter` and
     * `example_value` like below.
     *
     * ```
     * "responseContent":
     *   "{\"access_token\":\"(abbrev)\",\"example_parameter\":\"example_value\",...}"
     * ```
     *
     * and this will result in that the client application will receive a
     * JSON which contains the pair like the following.
     *
     * ```
     * {
     *   "access_token": "(abbrev)",
     *   "example_parameter": "example_value",
     *   ...
     * }
     *
     * ```
     * On the other hand, if you mark a property as hidden like below,
     *
     * ```
     * "properties": [
     *   {
     *     "key":    "hidden_parameter",
     *     "value":  "hidden_value",
     *     "hidden": true
     *   }
     * ]
     * ```
     *
     * the client application will never see the property in any response
     * from your authorization server. However, of course, the property is
     * still associated with the access token and it can be confirmed by
     * calling Authlete's `/api/auth/introspection` API (which is an API to
     * get information about an access token). A response from the API
     * contains all properties associated with the given access token
     * regardless of whether they are hidden or visible. The following is
     * an example response from Authlete's `/api/auth/introspection` API.
     *
     * ```
     * {
     *   "type":"introspectionResponse",
     *   "resultCode":"A056001",
     *   "resultMessage":"[A056001] The access token is valid.",
     *   "action":"OK",
     *   "clientId":5008706718,
     *   "existent":true,
     *   "expiresAt":1463310477000,
     *   "properties":[
     *     {
     *       "hidden":false,
     *       "key":"example_parameter",
     *       "value":"example_value"
     *     },
     *     {
     *       "hidden":true,
     *       "key":"hidden_parameter",
     *       "value":"hidden_value"
     *     }
     *   ],
     *   "refreshable":true,
     *   "responseContent":"Bearer error=\"invalid_request\"",
     *   "subject":"user123",
     *   "sufficient":true,
     *   "usable":true
     * }
     * ```
     *
     * @param boolean $hidden
     *     `true` to hide this property from the client application
     *
     * @return Property
     *     `$this` property.
     */
    public function setHidden(bool $hidden): Property
    {
        ValidationUtility::ensureBoolean('$hidden', $hidden);

        $this->hidden = $hidden;

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
        $array['key']    = $this->key;
        $array['value']  = $this->value;
        $array['hidden'] = $this->hidden;
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
        // key
        $this->setKey(
            LanguageUtility::getFromArray('key', $array));

        // value
        $this->setValue(
            LanguageUtility::getFromArray('value', $array));

        // hidden
        $this->setHidden(
            LanguageUtility::getFromArrayAsBoolean('hidden', $array));
    }
}
