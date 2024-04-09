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
 * File containing the definition of AuthorizationFailRequest class.
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
 * Request to Authlete's /api/auth/authorization/fail API.
 *
 * An authorization endpoint implementation is supposed to call the API
 * to generate an error response to a client application.
 */
class AuthorizationFailRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $ticket                  = null;
    private ?AuthorizationFailReason $reason = null;
    private ?string $description             = null;


    /**
     * Get the ticket issued by Authlete's /api/auth/authorization API.
     *
     * The ticket is necessary to call Authlete's /api/auth/authorization/fail
     * API.
     *
     * @return string|null The ticket issued by Authlete's /api/auth/authorization API.
     *     The ticket issued by Authlete's /api/auth/authorization API.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket issued by Authlete's /api/auth/authorization API.
     * This request parameter is mandatory.
     *
     * The ticket is necessary to call Authlete's /api/auth/authorization/fail
     * API.
     *
     * @param string $ticket
     *     The ticket issued by Authlete's /api/auth/authorization API.
     *
     * @return AuthorizationFailRequest
     *     `$this` object.
     */
    public function setTicket(mixed $ticket): AuthorizationFailRequest
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the reason of the failure of the authorization request.
     *
     * @return AuthorizationFailReason|null The reason of the failure of the authorization request.
     *     The reason of the failure of the authorization request.
     */
    public function getReason(): ?AuthorizationFailReason
    {
        return $this->reason;
    }


    /**
     * Set the reason of the failure of the authorization request.
     * This request parameter is mandatory.
     *
     * @param AuthorizationFailReason|null $reason
     *     The reason of the failure of the authorization request.
     *
     * @return AuthorizationFailRequest
     *     `$this` object.
     */
    public function setReason(AuthorizationFailReason $reason = null): AuthorizationFailRequest
    {
        $this->reason = $reason;

        return $this;
    }


    /**
     * Get the custom description about the authorization failure.
     *
     * @return string|null The custom description.
     *     The custom description.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }


    /**
     * Set the custom description about the authorization failure.
     * This request parameter is optional.
     *
     * @param string $description
     *     The custom description.
     *
     * @return AuthorizationFailRequest
     *     `$this` object.
     */
    public function setDescription(mixed $description): AuthorizationFailRequest
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->description = $description;

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
        $array['ticket']      = $this->ticket;
        $array['reason']      = LanguageUtility::toString($this->reason);
        $array['description'] = $this->description;
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

        // reason
        $this->setReason(
            AuthorizationFailReason::valueOf(
                LanguageUtility::getFromArray('reason', $array)));

        // description
        $this->setDescription(
            LanguageUtility::getFromArray('description', $array));
    }
}

