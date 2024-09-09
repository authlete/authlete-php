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
 * File containing the definition of GrantScope class.
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
 * Scope representation in a grant.
 *
 * This class holds the same information as each entry in the `scopes` array
 * in the response from the grant management endpoint on the grant management
 * action `query` does.
 *
 * @since 1.13.0
 */
class GrantScope implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $scope    = null;  // string
    private $resource = null;  // array of string


    /**
     * Get the space-delimited scopes.
     *
     * @return string
     *     The space-delimited scopes.
     */
    public function getScope()
    {
        return $this->scope;
    }


    /**
     * Set the space-delimited scopes.
     *
     * @param string $scope
     *     The space-delimited scopes.
     *
     * @return GrantScope
     *     `$this` object.
     */
    public function setScope($scope)
    {
        ValidationUtility::ensureNullOrString('$scope', $scope);

        $this->scope = $scope;

        return $this;
    }


    /**
     * Get the resource.
     *
     * @return string[]
     *      A list of resource indicators.
     */
    public function getResource()
    {
        return $this->resource;
    }


    /**
     * Set the resource.
     *
     * @param string[] $resource
     *     A list of resource indicators.
     *
     * @return GrantScope
     *     `$this` object.
     */
    public function setResource(array $resource = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$resource', $resource);

        $this->resource = $resource;

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
        $array['scope']    = $this->scope;
        $array['resource'] = $this->resource;
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
        // scope
        $this->setScope(
            LanguageUtility::getFromArray('scope', $array));

        // resource
        $_resource = LanguageUtility::getFromArray('resource', $array);
        $this->setResource($_resource);
    }
}
?>
