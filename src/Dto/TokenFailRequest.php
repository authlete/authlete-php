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
 * File containing the definition of TokenFailRequest class.
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
 * Request to Authlete's /api/auth/token/fail API.
 */
class TokenFailRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string          $ticket = null;
    private ?TokenFailReason $reason = null;


    /**
     * Get the ticket issued from Authlete's /api/auth/token API.
     *
     * @return string|null
     *     The ticket necessary to call /api/auth/token/fail API.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket issued from Authlete's /api/auth/token API.
     *
     * This request parameter is mandatory.
     *
     * @param string $ticket
     *     The ticket necessary to call /api/auth/token/fail API.
     *
     * @return TokenFailRequest
     *     `$this` object.
     */
    public function setTicket(string $ticket): TokenFailRequest
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the reason of the failure of the token request.
     *
     * @return TokenFailReason|null
     *     The reason of the failure of the token request.
     */
    public function getReason(): ?TokenFailReason
    {
        return $this->reason;
    }


    /**
     * Set the reason of the failure of the token request.
     *
     * @param TokenFailReason|null $reason
     *     The reason of the failure of the token request.
     *
     * @return TokenFailRequest
     *     `$this` object.
     */
    public function setReason(TokenFailReason $reason = null): TokenFailRequest
    {
        $this->reason = $reason;

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
        $array['ticket'] = $this->ticket;
        $array['reason'] = LanguageUtility::toString($this->reason);
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
        // ticket
        $this->setTicket(
            LanguageUtility::getFromArray('ticket', $array));

        // reason
        $this->setReason(
            TokenFailReason::valueOf(
                LanguageUtility::getFromArray('reason', $array)));
    }
}
