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
 * File containing the definition of Scope class.
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
 * Information about a scope.
 *
 * @see https://tools.ietf.org/html/rfc6749#section-3.3 RFC 6749, 3.3. Access Token Scope
 */
class Scope implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $name         = null;
    private bool $defaultEntry    = false;
    private ?string $description  = null;
    private ?array $descriptions  = null;
    private ?array $attributes    = null;


    /**
     * Get the scope name.
     *
     * @return string|null
     *     The scope name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * Set the scope name.
     *
     * Valid characters for scope names are listed in
     * [3.3. Access Token Scope](https://tools.ietf.org/html/rfc6749#section-3.3)
     * of [RFC 6749](https://tools.ietf.org/html/rfc6749).
     *
     * @param string $name
     *     The scope name.
     *
     * @return Scope
     *     `$this` object.
     */
    public function setName(string $name): Scope
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->name = $name;

        return $this;
    }


    /**
     * Get the flag which indicates whether this scope is included in the
     * default scope set.
     *
     * @return bool
     *     `true` if this scope is included in the default scope set.
     */
    public function isDefault(): bool
    {
        return $this->defaultEntry;
    }


    /**
     * Set the flag which indicates whether this scope is included in the
     * default scope set.
     *
     * When an authorization request does not include the `scope` request
     * parameter, scopes in the default scope set are used.
     *
     * @param bool $default
     *     `true` to include this scope in the default scope set.
     *
     * @return Scope
     *     `$this` object.
     */
    public function setDefault(bool $default): Scope
    {
        ValidationUtility::ensureBoolean('$default', $default);

        $this->defaultEntry = $default;

        return $this;
    }


    /**
     * Get the description of this scope.
     *
     * @return string|null
     *     The description of this scope.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }


    /**
     * Set the description of this scope.
     *
     * @param string $description
     *     The description of this scope.
     *
     * @return Scope
     *     `$this` object.
     */
    public function setDescription(string $description): Scope
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->description = $description;

        return $this;
    }


    /**
     * Get the localized descriptions of this scope.
     *
     * @return array|null
     *     The localized descriptions of this scope.
     */
    public function getDescriptions(): ?array
    {
        return $this->descriptions;
    }


    /**
     * Set the localized descriptions of this scope.
     *
     * @param TaggedValue[] $descriptions
     *     The localized descriptions of this scope.
     *
     * @return Scope
     *     `$this` object.
     */
    public function setDescriptions(array $descriptions = null): Scope
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$descriptions', __NAMESPACE__ . '\TaggedValue', $descriptions);

        $this->descriptions = $descriptions;

        return $this;
    }


    /**
     * Get the attributes of this scope.
     *
     * @return array|null
     *     The attributes of this scope.
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }


    /**
     * Set the attributes of this scope.
     *
     * @param Pair[] $attributes
     *     The attributes of this scope.
     *
     * @return Scope
     *     `$this` object.
     */
    public function setAttributes(array $attributes = null): Scope
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$attributes', __NAMESPACE__ . '\Pair', $attributes);

        $this->attributes = $attributes;

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
        $array['name']         = $this->name;
        $array['defaultEntry'] = $this->defaultEntry;
        $array['description']  = $this->description;
        $array['descriptions'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->descriptions);
        $array['attributes']   = LanguageUtility::convertArrayOfArrayCopyableToArray($this->attributes);
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
        // name
        $this->setName(
            LanguageUtility::getFromArray('name', $array));

        // defaultEntry
        $this->setDefault(
            LanguageUtility::getFromArrayAsBoolean('defaultEntry', $array));

        // description
        $this->setDescription(
            LanguageUtility::getFromArray('description', $array));

        // descriptions
        $_descriptions = LanguageUtility::getFromArray('descriptions', $array);
        $_descriptions = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\TaggedValue', $_descriptions);
        $this->setDescriptions($_descriptions);

        // attributes
        $_attributes = LanguageUtility::getFromArray('attributes', $array);
        $_attributes = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Pair', $_attributes);
        $this->setAttributes($_attributes);
    }
}

