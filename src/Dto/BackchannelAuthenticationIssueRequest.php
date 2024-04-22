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
 * File containing the definition of BackchannelAuthenticationIssueRequest class.
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
 * Request to Authlete's /api/backchannle/authentication/issue API.
 *
 * The API prepares JSON that contains an `auth_req_id`. The JSON should be
 * used as the response body of the response which is returned to the client
 * from the backchannel authentication endpoint.
 *
 * @since 1.8
 */
class BackchannelAuthenticationIssueRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $ticket = null;  // string


    /**
     * Get the ticket which is necessary to call Authlete's
     * `/api/backchannel/authentication/issue` API.
     *
     * @return string|null
     *     A ticket.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket which is necessary to call Authlete's
     * `/api/backchannel/authentication/issue` API.
     *
     * @param string $ticket
     *     A ticket previously issued by Authlete's
     *     `/api/backchannel/authentication` API.
     *
     * @return BackchannelAuthenticationIssueRequest
     *     `$this` object.
     */
    public function setTicket(string $ticket): BackchannelAuthenticationIssueRequest
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

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
        $array['ticket'] = $this->ticket;
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
    }
}

