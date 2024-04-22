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
 * File containing the definition of TaggedValue class.
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
 * A string value with a language tag.
 *
 * @see https://en.wikipedia.org/wiki/IETF_language_tag Language Tag
 */
class TaggedValue implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $tag;
    private ?string $value;


    /**
     * Constructor.
     *
     * @param string|null $tag
     *     The language tag. This parameter is optional. Its default value
     *     is `null`.
     *
     * @param string|null $value
     *     The value. This parameter is optional. Its default value is `null`.
     */
    public function __construct(string $tag = null, string $value = null)
    {
        ValidationUtility::ensureNullOrString('$tag',    $tag);
        ValidationUtility::ensureNullOrString('$value',  $value);

        $this->tag   = $tag;
        $this->value = $value;
    }


    /**
     * Get the language tag.
     *
     * @return string
     *     The language tag.
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }


    /**
     * Set the language tag.
     *
     * @param string $tag
     *     The language tag.
     *
     * @return TaggedValue
     *     `$this` object.
     */
    public function setTag(mixed $tag): TaggedValue
    {
        ValidationUtility::ensureNullOrString('$tag', $tag);

        $this->tag = $tag;

        return $this;
    }


    /**
     * Get the value.
     *
     * @return string
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
     * @return TaggedValue
     *     `$this` object.
     */
    public function setValue(mixed $value): TaggedValue
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
        $array['tag']   = $this->tag;
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
        // tag
        $this->setTag(
            LanguageUtility::getFromArray('tag', $array));

        // value
        $this->setValue(
            LanguageUtility::getFromArray('value', $array));
    }
}
