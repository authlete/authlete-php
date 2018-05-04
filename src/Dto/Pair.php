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


    private $key    = null;  // string
    private $value  = null;  // string


    /**
     * Constructor.
     *
     * @param string $key
     *     The key.
     *
     * @param string $value
     *     The value.
     */
    public function __construct($key = null, $value = null)
    {
        ValidationUtility::ensureNullOrString('$key',   $key);
        ValidationUtility::ensureNullOrString('$value', $value);

        $this->key   = $key;
        $this->value = $value;
    }


    /**
     * Get the key.
     *
     * @return string
     *     The key.
     */
    public function getKey()
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
    public function setKey($key)
    {
        ValidationUtility::ensureNullOrString('$key', $key);

        $this->key = $key;

        return $this;
    }


    /**
     * Get the value.
     *
     * @return string
     *     The value.
     */
    public function getValue()
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
    public function setValue($value)
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
    public function copyToArray(array &$array)
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
    public function copyFromArray(array &$array)
    {
        // key
        $this->setKey(
            LanguageUtility::getFromArray('key', $array));

        // value
        $this->setValue(
            LanguageUtility::getFromArray('value', $array));
    }
}
?>
