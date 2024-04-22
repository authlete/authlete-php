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
 * File containing the definition of ClientListResponse class.
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
 * Response from Authlete's /api/client/get/list API.
 */
class ClientListResponse implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private int $start         = 0;
    private int $end           = 0;
    private ?string $developer = null;
    private int $totalCount    = 0;
    private ?array $clients    = null;  // array of \Authlete\Dto\Client


    /**
     * Get the start index (inclusive) for the result set of the query.
     *
     * It is the value contained in the original request (= the value of
     * the `start` request parameter), or the default value (0) if the
     * original request did not contain the parameter.
     *
     * @return integer
     *     The start index (inclusive).
     */
    public function getStart(): int
    {
        return $this->start;
    }


    /**
     * Set the start index (inclusive) for the result set of the query.
     *
     * @param integer $start
     *     The start index (inclusive).
     *
     * @return ClientListResponse
     *     `$this` object.
     */
    public function setStart(int $start): ClientListResponse
    {
        ValidationUtility::ensureInteger('$start', $start);

        $this->start = $start;

        return $this;
    }


    /**
     * Get the end index (exclusive) for the result set of the query.
     *
     * It is the value contained in the original request (= the value of the
     * `end` request parameter), or the defaul value defined in the Authlete
     * server if the original request did not contain the parameter.
     *
     * @return integer
     *     The end index (exclusive).
     */
    public function getEnd(): int
    {
        return $this->end;
    }


    /**
     * Set the end index (exclusive) for the result set of the query.
     *
     * @param integer $end
     *     The end index (exclusive).
     *
     * @return ClientListResponse
     *     `$this` object.
     */
    public function setEnd(int $end): ClientListResponse
    {
        ValidationUtility::ensureInteger('$end', $end);

        $this->end = $end;

        return $this;
    }


    /**
     * Get the unique identifier of the developer.
     *
     * It is the value contained in the original request (= the value of the
     * `developer` request parameter), or `null`. In the case of `null`, it
     * means that all the clients that belong to the service are targeted.
     *
     * @return string|null
     *     The unique identifier of the developer.
     */
    public function getDeveloper(): ?string
    {
        return $this->developer;
    }


    /**
     * Set the unique identifier of the developer.
     *
     * @param string $developer
     *     The unique identifier of the developer.
     *
     * @return ClientListResponse
     *     `$this` object.
     */
    public function setDeveloper(string $developer): ClientListResponse
    {
        ValidationUtility::ensureNullOrString('$developer', $developer);

        $this->developer = $developer;

        return $this;
    }


    /**
     * Get the total count of client applications of either the entire
     * service (in the case of developer=null) or the developer.
     *
     * The number this method returns is not the size of the array returned
     * from `getClients()` method. Instead, it is the total number of the
     * client applications (of either the entire service or the developer)
     * which exist in Authlete's database.
     *
     * @return integer
     *     The total number of client applications of either the entire
     *     service or the developer.
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }


    /**
     * Set the total count of client applications of either the entire
     * service (in the case of developer=null) or the developer.
     *
     * @param integer $totalCount
     *     The total number of client applications of either the entire
     *     service or the developer.
     *
     * @return ClientListResponse
     *     `$this` object.
     */
    public function setTotalCount(int $totalCount): ClientListResponse
    {
        ValidationUtility::ensureInteger('$totalCount', $totalCount);

        $this->totalCount = $totalCount;

        return $this;
    }


    /**
     * Get the list of client applications that match the query conditions.
     *
     * @return array|null
     *     The list of client applications that match the query conditions.
     */
    public function getClients(): ?array
    {
        return $this->clients;
    }


    /**
     * Set the list of client applications that match the query conditions.
     *
     * @param Client[] $clients
     *     The list of client applications that match the query conditions.
     *
     * @return ClientListResponse
     *     `$this` object.
     */
    public function setClients(array $clients = null): ClientListResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$clients', __NAMESPACE__ . '\Client', $clients);

        $this->clients = $clients;

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
        $array['start']      = $this->start;
        $array['end']        = $this->end;
        $array['developer']  = $this->developer;
        $array['totalCount'] = $this->totalCount;
        $array['clients']    = LanguageUtility::convertArrayOfArrayCopyableToArray($this->clients);
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
        // start
        $this->setStart(
            LanguageUtility::getFromArray('start', $array));

        // end
        $this->setEnd(
            LanguageUtility::getFromArray('end', $array));

        // developer
        $this->setDeveloper(
            LanguageUtility::getFromArray('developer', $array));

        // totalCount
        $this->setTotalCount(
            LanguageUtility::getFromArray('totalCount', $array));

        // clients
        $_clients = LanguageUtility::getFromArray('clients', $array);
        $_clients = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Client', $_clients);
        $this->setClients($_clients);
    }
}

