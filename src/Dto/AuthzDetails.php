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
 * File containing the definition of AuthzDetails class.
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
 * A class that represents `authorization_details` which is defined in RFC 9396
 * OAuth 2.0 Rich Authorization Requests.
 *
 * @since 1.13.0
 */
class AuthzDetails implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $elements = null;  // array of \Authlete\Dto\AuthzDetailsElement


    /**
     * Get the elements of this authorization details.
     *
     * @return AuthzDetailsElement[]
     *     The elements of this authorization details.
     */
    public function getElements()
    {
        return $this->elements;
    }


    /**
     * Set the elements of this authorization details.
     *
     * @param AuthzDetailsElement[] $elements
     *     The elements of this authorization details.
     *
     * @return AuthzDetails
     *     `$this` object.
     */
    public function setElements(array $elements = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$elements', $elements, __NAMESPACE__ . '\AuthzDetailsElement');

        $this->elements = $elements;

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
        $array['elements'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->elements);
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
        // elements
        $_elements = LanguageUtility::getFromArray('elements', $array);
        $_elements = LanguageUtility::convertArrayToArrayOfArrayCopyable($_elements, __NAMESPACE__ . '\AuthzDetailsElement');
        $this->setElements($_elements);
    }
}
?>
