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
 * File containing the definition of BackchannelAuthenticationFailRequest class.
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
 * Request to Authlete's /api/backchannel/authentication/fail API.
 *
 * The API prepares JSON that contains an `error` property and optionally
 * others. The JSON should be used as the response body of the response
 * which is returned to the client from the backchannel authentication
 * endpoint.
 *
 * @since 1.8
 */
class BackchannelAuthenticationFailRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?BackchannelAuthenticationFailReason $reason = null;
    private ?string $ticket                              = null;
    private ?string $errorDescription                    = null;
    private ?string $errorUri                            = null;


    /**
     * Get the ticket which should be deleted on a call of Authlete's
     * `/api/backchannle/authentication/fail` API.
     *
     * @return string|null
     *     A ticket.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket which should be deleted on a call of Authlete's
     * `/api/backchannle/authentication/fail` API.
     *
     * This request parameter is not mandatory but optional. If this request
     * parameter is given and the ticket belongs to the service, the specified
     * ticket is deleted from the database. Giving this parameter is
     * recommended to clean up the storage area for the service.
     *
     * @param string $ticket
     *     A ticket previously issued by Authlete's
     *     `/api/backchannel/authentication` API.
     *
     * @return BackchannelAuthenticationFailRequest
     *     `$this` object.
     */
    public function setTicket(string $ticket): BackchannelAuthenticationFailRequest
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

        return $this;
    }


    /**
     * Get the reason of the failure of the backchannel authentication request.
     *
     * @return BackchannelAuthenticationFailReason|null
     *     The reason of the failure of the backchannel authentication request.
     */
    public function getReason(): ?BackchannelAuthenticationFailReason
    {
        return $this->reason;
    }


    /**
     * Set the reason of the failure of the backchannel authentication request.
     *
     * This request parameter is not mandatory but optional. However, giving
     * this parameter is recommended. If omitted, `SERVER_ERROR` is used as a
     * reason.
     *
     * @param BackchannelAuthenticationFailReason|null $reason
     *     The reason of the failure of the backchannel authentication request.
     *
     * @return BackchannelAuthenticationFailRequest
     *     `$this` object.
     */
    public function setReason(BackchannelAuthenticationFailReason $reason = null): BackchannelAuthenticationFailRequest
    {
        $this->reason = $reason;

        return $this;
    }


    /**
     * Get the description of the error. This corresponds to the
     * `error_description` property in the response to the client.
     *
     * @return string|null
     *     The description of the error.
     */
    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }


    /**
     * Set the description of the error. This corresponds to the
     * `error_description` property in the response to the client.
     *
     * If this optional request parameter is given, its value is used as the
     * value of the `error_description` property.
     *
     * To comply with the specification strictly, the description must not
     * include characters outside the set %x20-21 / %x23-5B / %x5D-7E.
     *
     * @param string $description
     *     The description of the error.
     *
     * @return BackchannelAuthenticationFailRequest
     *     `$this` object.
     */
    public function setErrorDescription(string $description): BackchannelAuthenticationFailRequest
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->errorDescription = $description;

        return $this;
    }


    /**
     * Get the URI of a document which describes the error in detail. This
     * corresponds to the `error_uri` property in the response to the client.
     *
     * @return string|null
     *     The URI of a document which describes the error in detail.
     */
    public function getErrorUri(): ?string
    {
        return $this->errorUri;
    }


    /**
     * Set the URI of a document which describes the error in detail. This
     * corresponds to the `error_uri` property in the response to the client.
     *
     * If this optional request parameter is given, its value is used as the
     * value of the `error_uri` property.
     *
     * @param string $uri
     *     The URI of a document which describes the error in detail.
     *
     * @return BackchannelAuthenticationFailRequest
     *     `$this` object.
     */
    public function setErrorUri(string $uri): BackchannelAuthenticationFailRequest
    {
        ValidationUtility::ensureNullOrString('$uri', $uri);

        $this->errorUri = $uri;

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
        $array['ticket']           = $this->ticket;
        $array['reason']           = LanguageUtility::toString($this->reason);
        $array['errorDescription'] = $this->errorDescription;
        $array['errorUri']         = $this->errorUri;
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
            BackchannelAuthenticationFailReason::valueOf(
                LanguageUtility::getFromArray('reason', $array)));

        // errorDescription
        $this->setErrorDescription(
            LanguageUtility::getFromArray('errorDescription', $array));

        // errorUri
        $this->setErrorUri(
            LanguageUtility::getFromArray('errorUri', $array));
    }
}

