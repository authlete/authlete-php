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
 * File containing the definition of ClientAuthorizationGetListRequest class.
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
 * Request to Authlete's /api/client/authorization/get/list API.
 *
 * The API returns a list of client applications to which an end-user has
 * granted authorization.
 */
class ClientAuthorizationGetListRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $subject   = null;  // string
    private $developer = null;  // string
    private $start     = 0;     // integer
    private $end       = 0;     // integer


    /**
     * Constructor.
     *
     * @param string $subject
     *     The subject (= unique identifier) of the end-user. This argument
     *     is optional. The default value is `null`. However, note that
     *     `subject` request parameter is mandatory for the Authlete API.
     *
     * @param string $developer
     *     The unique identifier of a developer. This argument is optional.
     *     The default value is `null`.
     *
     * @param integer $start
     *     A start index of search results (inclusive). This argument is
     *     optional. The default value is 0.
     *
     * @param integer $end
     *     An end index of search results (exclusive). This argument is
     *     optional. The default value is 5.
     */
    public function __construct(
        $subject = null, $developer = null, $start = 0, $end = 5)
    {
        $this->subject   = $subject;
        $this->developer = $developer;
        $this->start     = $start;
        $this->end       = $end;
    }


    /**
     * Get the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * @return string
     *     The subject of the end-user.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user who has granted
     * authorization to the client application.
     *
     * @param string $subject
     *     The subject of the end-user.
     *
     * @return ClientAuthorizationGetListRequest
     *     `$this` object.
     */
    public function setSubject($subject)
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the unique identifier of a developer.
     *
     * @return string
     *     The unique identifier of a developer.
     */
    public function getDeveloper()
    {
        return $this->developer;
    }


    /**
     * Set the unique identifier of a developer.
     *
     * If a non-null value is given, client applications which do not belong
     * to the developer won't be included in the response from the Authlete
     * API.
     *
     * @param string $developer
     *     The unique identifier of a developer.
     *
     * @return ClientAuthorizationGetListRequest
     *     `$this` object.
     */
    public function setDeveloper($developer)
    {
        ValidationUtility::ensureNullOrString('$developer', $developer);

        $this->developer = $developer;

        return $this;
    }


    /**
     * Get a start index of search results (inclusive).
     *
     * @return integer
     *     A start index of search results (inclusive).
     */
    public function getStart()
    {
        return $this->start;
    }


    /**
     * Set a start index of search results (inclusive).
     *
     * @param integer $start
     *     A start index of search results (inclusive).
     *
     * @return ClientAuthorizationGetListRequest
     *     `$this` object.
     */
    public function setStart($start)
    {
        ValidationUtility::ensureInteger('$start', $start);

        $this->start = $start;

        return $this;
    }


    /**
     * Get an end index of search results (exclusive).
     *
     * @return integer
     *     An end index of search results (exclusive).
     */
    public function getEnd()
    {
        return $this->end;
    }


    /**
     * Set an end index of search results (exclusive).
     *
     * @param integer $end
     *     An end index of search results (exclusive).
     *
     * @return ClientAuthorizationGetListRequest
     *     `$this` object.
     */
    public function setEnd($end)
    {
        ValidationUtility::ensureInteger('$end', $end);

        $this->end = $end;

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
        $array['subject']   = $this->subject;
        $array['developer'] = $this->developer;
        $array['start']     = $this->start;
        $array['end']       = $this->end;
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
        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // developer
        $this->setDeveloper(
            LanguageUtility::getFromArray('developer', $array));

        // start
        $this->setStart(
            LanguageUtility::parseInteger(
                getFromArray('start', $array)));

        // end
        $this->setEnd(
            LanguageUtility::parseInteger(
                getFromArray('end', $array)));
    }
}
?>
