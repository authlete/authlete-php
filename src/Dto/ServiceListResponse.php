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
 * File containing the definition of ServiceListResponse class.
 */


namespace Authlete\Dto;


use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/service/get/list API.
 */
class ServiceListResponse implements ArrayCopyable, Jsonable
{
    use JsonTrait;


    private $start      = 0;     // integer
    private $end        = 0;     // integer
    private $totalCount = 0;     // integer
    private $services   = null;  // array of \Authlete\Dto\Service


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
    public function getStart()
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
    public function setStart($start)
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
    public function getEnd()
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
    public function setEnd($end)
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
    public function getTotalCount()
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
    public function setTotalCount($totalCount)
    {
        ValidationUtility::ensureInteger('$totalCount', $totalCount);

        $this->totalCount = $totalCount;

        return $this;
    }


    /**
     * Get the list of services that match the query conditions.
     *
     * @return Service[]
     *     The list of services that match the query conditions.
     */
    public function getServices()
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
    public function setServices(array $services = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$services', $services, __NAMESPACE__ . '\Service');

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
    public function copyToArray(array &$array)
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
    public function copyFromArray(array &$array)
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
        $this->setServices(
            LanguageUtility::convertArrayToArrayOfArrayCopyable(
                LanguageUtility::getFromArray('services', $array),
                __NAMESPACE__ . '\Service'));
    }
}
?>
