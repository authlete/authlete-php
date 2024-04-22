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
 * File containing the definition of Pair class.
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
 * A pair of a string key and a string value.
 */
class Pair implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $key;
    private ?string $value;


    /**
     * Constructor.
     *
     * @param string|null $key
     *     The key.
     *
     * @param string|null $value
     *     The value.
     */
    public function __construct(string $key = null, string $value = null)
    {
        ValidationUtility::ensureNullOrString('$key',   $key);
        ValidationUtility::ensureNullOrString('$value', $value);

        $this->key   = $key;
        $this->value = $value;
    }


    /**
     * Get the key.
     *
     * @return string|null The key.
     *     The key.
     */
    public function getKey(): ?string
    {
        return $this->key;
    }


    /**
     * Set the key.
     *
     * @param string $key
     *     The key.
     *
     * @return Pair
     *     `$this` object.
     */
    public function setKey(string $key): Pair
    {
        ValidationUtility::ensureNullOrString('$key', $key);

        $this->key = $key;

        return $this;
    }


    /**
     * Get the value.
     *
     * @return string|null
     *     The value.
     */
    public function getValue(): ?string
    {
        return $this->value;
    }


    /**
     * Set the value.
     *
     * @param string $value
     *     The value.
     *
     * @return Pair
     *     `$this` object.
     */
    public function setValue(string $value): Pair
    {
        ValidationUtility::ensureNullOrString('$value', $value);

        $this->value = $value;

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
        $array['key']   = $this->key;
        $array['value'] = $this->value;
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
    }
}

