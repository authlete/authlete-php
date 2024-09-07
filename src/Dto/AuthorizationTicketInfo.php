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
 * File containing the definition of AuthorizationTicketInfo class.
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
 * Information about a ticket that has been issued from the
 * `/auth/authorization` API.
 *
 * @since 1.13.0
 */
class AuthorizationTicketInfo implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $context = null;  // string


    /**
     * Constructor.
     *
     * @param string $context
     *     The arbitrary text attached to the ticket.
     */
    public function __construct($context = null)
    {
        ValidationUtility::ensureNullOrString('$context', $context);

        $this->context = $context;
    }


    /**
     * Get the arbitrary text attached to the ticket.
     *
     * @return string
     *     The arbitrary text.
     */
    public function getContext()
    {
        return $this->context;
    }


    /**
     * Set the arbitrary text attached to the ticket.
     *
     * @param string $context
     *     The arbitrary text.
     *
     * @return AuthorizationTicketInfo
     *     `$this` object.
     */
    public function setContext($context)
    {
        ValidationUtility::ensureNullOrString('$context', $context);

        $this->context = $context;

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
        $array['context'] = $this->context;
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
        // context
        $this->setContext(
            LanguageUtility::getFromArray('context', $array));
    }
}
?>
