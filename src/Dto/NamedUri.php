<?php
//
// Copyright (C) 2020 Authlete, Inc.
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
 * File containing the definition of NamedUri class.
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
 * Named URI.
 *
 * @since 1.8
 */
class NamedUri implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $name;
    private ?string $uri;


    /**
     * Constructor.
     *
     * @param string|null $name
     *     The name of the URI.
     *
     * @param string|null $uri
     *     The URI.
     */
    public function __construct(string $name = null, string $uri = null)
    {
        ValidationUtility::ensureNullOrString('$name', $name);
        ValidationUtility::ensureNullOrString('$uri',  $uri);

        $this->name = $name;
        $this->uri  = $uri;
    }


    /**
     * Get the name of the URI.
     *
     * @return string|null
     *     The name of the URI.
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * Set the name of the URI.
     *
     * @param string $name
     *     The name of the URI.
     *
     * @return NamedUri
     *     `$this` object.
     */
    public function setName(string $name): NamedUri
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->name = $name;

        return $this;
    }


    /**
     * Get the URI.
     *
     * @return string|null
     *     The URI.
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }


    /**
     * Set the URI.
     *
     * @param string $uri
     *     The URI.
     *
     * @return NamedUri
     *     `$this` object.
     */
    public function setUri(string $uri): NamedUri
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->uri = $uri;

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
        $array['name'] = $this->name;
        $array['uri']  = $this->uri;
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

        // uri
        $this->setUri(
            LanguageUtility::getFromArray('uri', $array));
    }
}

