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
 * File containing the definition of AuthzDetailsElement class.
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
 * A class that represents an element in `authorization_details` which is
 * defined in RFC 9396 OAuth 2.0 Rich Authorization Requests.
 *
 * @since 1.13.0
 */
class AuthzDetailsElement implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $type        = null;  // string
    private $locations   = null;  // array of string
    private $actions     = null;  // array of string
    private $dataTypes   = null;  // array of string
    private $identifier  = null;  // string
    private $privileges  = null;  // array of string
    private $otherFields = null;  // string


    /**
     * Get the type of this element.
     *
     * @return string
     *     The type of this element.
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set the type of this element.
     *
     * @param string $type
     *     The type of this element.
     *
     * @return AuthzDetailsElement
     *     `$this` object.
     */
    public function setType($type)
    {
        ValidationUtility::ensureNullOrString('$type', $type);

        $this->type = $type;

        return $this;
    }


    /**
     * Get the locations.
     *
     * @return string[]
     *      Locations.
     */
    public function getLocations()
    {
        return $this->locations;
    }


    /**
     * Set the locations.
     *
     * @param string[] $locations
     *     Locations.
     *
     * @return AuthzDetailsElement
     *     `$this` object.
     */
    public function setLocations(array $locations = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$locations', $locations);

        $this->locations = $locations;

        return $this;
    }


    /**
     * Get the actions.
     *
     * @return string[]
     *      Actions.
     */
    public function getActions()
    {
        return $this->actions;
    }


    /**
     * Set the actions.
     *
     * @param string[] $actions
     *     Actions.
     *
     * @return AuthzDetailsElement
     *     `$this` object.
     */
    public function setActions(array $actions = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$actions', $actions);

        $this->actions = $actions;

        return $this;
    }


    /**
     * Get the data types.
     *
     * @return string[]
     *      Data types.
     */
    public function getDataTypes()
    {
        return $this->dataTypes;
    }


    /**
     * Set the data types.
     *
     * @param string[] $dataTypes
     *     Data types.
     *
     * @return AuthzDetailsElement
     *     `$this` object.
     */
    public function setDataTypes(array $dataTypes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$dataTypes', $dataTypes);

        $this->dataTypes = $dataTypes;

        return $this;
    }


    /**
     * Get the identifier.
     *
     * @return string
     *     Identifier.
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }


    /**
     * Set the identifier.
     *
     * @param string $identifier
     *     Identifier.
     *
     * @return AuthzDetailsElement
     *     `$this` object.
     */
    public function setIdentifier($identifier)
    {
        ValidationUtility::ensureNullOrString('$identifier', $identifier);

        $this->identifier = $identifier;

        return $this;
    }


    /**
     * Get the privileges.
     *
     * @return string[]
     *      Privileges.
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }


    /**
     * Set the privileges.
     *
     * @param string[] $privileges
     *     Privileges.
     *
     * @return AuthzDetailsElement
     *     `$this` object.
     */
    public function setPrivileges(array $privileges = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$privileges', $privileges);

        $this->privileges = $privileges;

        return $this;
    }


    /**
     * Get the other fields (than the pre-defined ones such as `type` and
     * `locations`) as a string in the JSON format.
     *
     * @return string
     *     Other fields in the JSON format.
     */
    public function getOtherFields()
    {
        return $this->otherFields;
    }


    /**
     * Set the other fields (than the pre-defined ones such as `type` and
     * `locations`) as a string in the JSON format.
     *
     * @param string $otherFields
     *     Other fields in the JSON format.
     *
     * @return AuthzDetailsElement
     *     `$this` object.
     */
    public function setOtherFields($otherFields)
    {
        ValidationUtility::ensureNullOrString('$otherFields', $otherFields);

        $this->otherFields = $otherFields;

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
        $array['type']        = $this->type;
        $array['locations']   = $this->locations;
        $array['actions']     = $this->actions;
        $array['dataTypes']   = $this->dataTypes;
        $array['identifier']  = $this->identifier;
        $array['privileges']  = $this->privileges;
        $array['otherFields'] = $this->otherFields;
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
        // type
        $this->setType(
            LanguageUtility::getFromArray('type', $array));

        // locations
        $_locations = LanguageUtility::getFromArray('locations', $array);
        $this->setLocations($_locations);

        // actions
        $_actions = LanguageUtility::getFromArray('actions', $array);
        $this->setActions($_actions);

        // dataTypes
        $_data_types = LanguageUtility::getFromArray('dataTypes', $array);
        $this->setDataTypes($_data_types);

        // identifier
        $this->setIdentifier(
            LanguageUtility::getFromArray('identifier', $array));

        // privileges
        $_privileges = LanguageUtility::getFromArray('privileges', $array);
        $this->setPrivileges($_privileges);

        // otherFields
        $this->setOtherFields(
            LanguageUtility::getFromArray('otherFields', $array));
    }
}
?>
