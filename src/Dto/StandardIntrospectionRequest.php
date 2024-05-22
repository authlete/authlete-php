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
 * File containing the definition of StandardIntrospectionRequest class.
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
 * Request to Authlete's /api/auth/introspection/standard API.
 */
class StandardIntrospectionRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $parameters           = null;
    private bool    $withHiddenProperties = false;


    /**
     * Get the request parameters which comply with the introspection request
     * defined in "2.1. Introspection Request" of RFC 7662.
     *
     * @return string
     *     The request parameters that the introspection endpoint of your
     *     authorization server received.
     *
     * @see https://tools.ietf.org/html/rfc7662#section-2.1" RFC 7662, 2.1. Introspection Request
     */
    public function getParameters(): ?string
    {
        return $this->parameters;
    }


    /**
     * Set the request parameters which comply with the introspection request
     * defined in "2.1. Introspection Request" of RFC 7662.
     *
     * The following is an example value.
     *
     * ```
     * token=pNj1h24a4geA_YHilxrshkRkxJDsyXBZWKp3hZ5ND7A&amp;token_type_hint=access_token
     * ```
     *
     * The implementation of the introspection endpoint of your authorization
     * server will receive an HTTP POST request with parameters in the
     * `application/x-www-form-urlencoded` format. It is the entity body of
     * the request that Authlete's `/api/auth/introspection/standard` API
     * expects as the value of the `parameters` request parameter.
     *
     * @param string $parameters
     *     The request parameters that the introspection endpoint of your
     *     authorization server received.
     *
     * @return StandardIntrospectionRequest
     *     `$this` object.
     *
     * @see https://tools.ietf.org/html/rfc7662#section-2.1" RFC 7662, 2.1. Introspection Request
     */
    public function setParameters(string $parameters): StandardIntrospectionRequest
    {
        ValidationUtility::ensureNullOrString('$parameters', $parameters);

        $this->parameters = $parameters;

        return $this;
    }


    /**
     * Get the flag which indicates whether to include hidden properties
     * associated with the token in the output.
     *
     * Authlete has a mechanism whereby to associate arbitrary key-value
     * pairs with an access token. Each key-value pair has a `hidden`
     * attribute. By default, key-value pairs whose `hidden` attribute is
     * true are not embedded in the standard introspection output.
     *
     * If the `withHiddenProperties` request parameter is given and its
     * value is `true`, `/api/auth/introspection/standard` API includes
     * all the associated key-value pairs into the output regardless of
     * the value of the `hidden` attribute.
     *
     * @return boolean
     *     `true` if hidden properties are included in the output.
     *
     * @since 1.10
     */
    public function isWithHiddenProperties(): bool
    {
        return $this->withHiddenProperties;
    }


    /**
     * Set the flag which indicates whether to include hidden properties
     * associated with the token in the output.
     *
     * See the description of `isWithHiddenProperties()` for details.
     *
     * @param boolean $with
     *     `true` to include hidden properties in the output.
     *
     * @return StandardIntrospectionRequest
     *     `$this` object.
     *
     * @since 1.10
     */
    public function setWithHiddenProperties(bool $with): StandardIntrospectionRequest
    {
        ValidationUtility::ensureBoolean('$with', $with);

        $this->withHiddenProperties = $with;

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
        $array['parameters']           = $this->parameters;
        $array['withHiddenProperties'] = $this->withHiddenProperties;
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
        // parameters
        $this->setParameters(
            LanguageUtility::getFromArray('parameters', $array));

        // withHiddenProperties
        $this->setWithHiddenProperties(
            LanguageUtility::getFromArrayAsBoolean('withHiddenProperties', $array));
    }
}
