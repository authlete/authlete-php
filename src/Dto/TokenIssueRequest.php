<?php
//
// Copyright (C) 2018-2021 Authlete, Inc.
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
 * File containing the definition of TokenIssueRequest class.
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
 * Request to Authlete's /api/auth/token/issue API.
 */
class TokenIssueRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $ticket     = null;
    private ?string $subject    = null;
    private ?array $properties  = null;  // array of \Authlete\Dto\Property


    /**
     * Get the ticket issued by Authlete's /api/auth/token API.
     *
     * @return string|null
     *     The ticket issued by Authlete's /api/auth/token API.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket issued by Authlete's /api/auth/token API.
     *
     * @param string $ticket
     *     The ticket issued by Authlete's /api/auth/token API.
     *
     * @return TokenIssueRequest
     *     `$this` object.
     */
    public function setTicket(string $ticket): TokenIssueRequest
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the authenticated end-user.
     *
     * @return string|null
     *     The subject of the end-user.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the authenticated end-user.
     *
     * @param string $subject
     *     The subject of the end-user.
     *
     * @return TokenIssueRequest
     *     `$this` object.
     */
    public function setSubject(string $subject): TokenIssueRequest
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get properties that are associated with a newly created access token.
     *
     * @return array|null
     *     Properties associated with the access token.
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }


    /**
     * Set properties that are associated with a newly created access token.
     *
     * @param Property[] $properties
     *     Properties associated with the access token.
     *
     * @return TokenIssueRequest
     *     `$this` object.
     */
    public function setProperties(array $properties = null): TokenIssueRequest
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', __NAMESPACE__ . '\Property', $properties);

        $this->properties = $properties;

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
        $array['ticket']     = $this->ticket;
        $array['subject']    = $this->subject;
        $array['properties'] = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
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
        // ticket
        $this->setTicket(
            LanguageUtility::getFromArray('ticket', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Property', $_properties);
        $this->setProperties($_properties);
    }
}
