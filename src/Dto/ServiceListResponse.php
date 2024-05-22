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
 * File containing the definition of ServiceListResponse class.
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
 * Response from Authlete's /api/service/get/list API.
 */
class ServiceListResponse implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private int    $start      = 0;
    private int    $end        = 0;
    private int    $totalCount = 0;
    private ?array $services   = null;  // array of \Authlete\Dto\Service


    /**
     * Get the index (inclusive) of the result set of the query.
     *
     * It is the value contained in the original request (= the value of the
     * `start` parameter), or the default value (0) if the original request
     * did not contain the parameter.
     *
     * @return integer
     *     The index (inclusive) of the result set of the query.
     */
    public function getStart(): int
    {
        return $this->start;
    }


    /**
     * Set the index (inclusive) of the result set of the query.
     *
     * @param integer $start
     *     The index (inclusive) of the result set of the query.
     *
     * @return ServiceListResponse
     *     `$this` object.
     */
    public function setStart(int $start): ServiceListResponse
    {
        ValidationUtility::ensureInteger('$start', $start);

        $this->start = $start;

        return $this;
    }


    /**
     * Get the end index (exclusive) of the result set of the query.
     *
     * It is the value contained in the original request (= the value of the
     * `end` parameter), or the default value defined in Authlete server if
     * the original request did not contain the parameter.
     *
     * @return integer
     *     The end index (exclusive) of the result set of the query.
     */
    public function getEnd(): int
    {
        return $this->end;
    }


    /**
     * Set the end index (exclusive) of the result set of the query.
     *
     * @param integer $end
     *     The end index (exclusive) of the result set of the query.
     *
     * @return ServiceListResponse
     *     `$this` object.
     */
    public function setEnd(int $end): ServiceListResponse
    {
        ValidationUtility::ensureInteger('$end', $end);

        $this->end = $end;

        return $this;
    }


    /**
     * Get the total number of services.
     *
     * The value of this property is not the size of the array returned from
     * `getServices()` method. Instead, it is the total number of services in
     * Authlete's database that match the query conditions.
     *
     * @return integer
     *     The total number of services.
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }


    /**
     * Set the total number of services.
     *
     * @param integer $totalCount
     *     The total number of services.
     *
     * @return ServiceListResponse
     *     `$this` object.
     */
    public function setTotalCount(int $totalCount): ServiceListResponse
    {
        ValidationUtility::ensureInteger('$totalCount', $totalCount);

        $this->totalCount = $totalCount;

        return $this;
    }


    /**
     * Get the list of services that match the query conditions.
     *
     * @return array|null
     *     The list of services that match the query conditions.
     */
    public function getServices(): ?array
    {
        return $this->services;
    }


    /**
     * Set the list of services that match the query conditions.
     *
     * @param Service[] $services
     *     The list of services that match the query conditions.
     *
     * @return ServiceListResponse
     *     `$this` object.
     */
    public function setServices(?array $services = null): ServiceListResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$services', __NAMESPACE__ . '\Service', $services);

        $this->services = $services;

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
        $array['totalCount'] = $this->totalCount;
        $array['services']   = LanguageUtility::convertArrayOfArrayCopyableToArray($this->services);
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

        // totalCount
        $this->setTotalCount(
            LanguageUtility::getFromArray('totalCount', $array));

        // services
        $_services = LanguageUtility::getFromArray('services', $array);
        $_services = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Service', $_services);
        $this->setServices($_services);
    }
}

