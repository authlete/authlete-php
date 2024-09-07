<?php
//
// Copyright (C) 2024 Authlete, Inc.
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
 * File containing the definition of DynamicScope class.
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
 * Dynamic scope.
 *
 * @since 1.13.0
 */
class DynamicScope implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $name  = null;  // string
    private $value = null;  // string


    /**
     * Constructor.
     *
     * @param string $name
     *     The scope name which is registered as one of supported scopes.
     *
     * @param string $value
     *     The scope value which was specified in the `scope` request parameter.
     */
    public function __construct($name = null, $value = null)
    {
        ValidationUtility::ensureNullOrString('$name',  $name);
        ValidationUtility::ensureNullOrString('$value', $value);

        $this->name  = $name;
        $this->value = $value;
    }


    /**
     * Get the scope name.
     *
     * @return string
     *     The scope name.
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set the scope name.
     *
     * @param string $name
     *     The scope name.
     *
     * @return DynamicScope
     *     `$this` object.
     */
    public function setName($name)
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->name = $name;

        return $this;
    }


    /**
     * Get the scope value.
     *
     * @return string
     *     The scope value.
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * Set the scope value.
     *
     * @param string $value
     *     The scope value.
     *
     * @return DynamicScope
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
        $array['name']  = $this->name;
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
        // name
        $this->setName(
            LanguageUtility::getFromArray('name', $array));

        // value
        $this->setValue(
            LanguageUtility::getFromArray('value', $array));
    }
}
?>
