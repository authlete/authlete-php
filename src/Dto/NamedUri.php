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


    private $name = null;  // string
    private $uri  = null;  // string


    /**
     * Constructor.
     *
     * @param string $name
     *     The name of the URI.
     *
     * @param string $uri
     *     The URI.
     */
    public function __construct($name = null, $uri = null)
    {
        ValidationUtility::ensureNullOrString('$name', $name);
        ValidationUtility::ensureNullOrString('$uri',  $uri);

        $this->name = $name;
        $this->uri  = $uri;
    }


    /**
     * Get the name of the URI.
     *
     * @return string
     *     The name of the URI.
     */
    public function getName()
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
    public function setName($name)
    {
        ValidationUtility::ensureNullOrString('$name', $name);

        $this->name = $name;

        return $this;
    }


    /**
     * Get the URI.
     *
     * @return string
     *     The URI.
     */
    public function getUri()
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
    public function setUri($uri)
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
    public function copyToArray(array &$array)
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
    public function copyFromArray(array &$array)
    {
        // name
        $this->setName(
            LanguageUtility::getFromArray('name', $array));

        // uri
        $this->setUri(
            LanguageUtility::getFromArray('uri', $array));
    }
}
?>
