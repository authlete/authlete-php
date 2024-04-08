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
 * File containing the definition of ApiResponse class.
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
 * The base class for classes that represent responses from Authlete APIs.
 */
class ApiResponse implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $resultCode    = null;  // string
    private ?string $resultMessage = null;  // string


    /**
     * Get the code of the result of an Authlete API call.
     *
     * @return string
     *     The result code.
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }


    /**
     * Set the code of the result of an Authlete API call.
     *
     * @param string $resultCode
     *     The result code.
     *
     * @return ApiResponse
     *     `$this` object.
     */
    public function setResultCode($resultCode)
    {
        ValidationUtility::ensureNullOrString('$resultCode', $resultCode);

        $this->resultCode = $resultCode;

        return $this;
    }


    /**
     * Get the message of the result of an Authlete API call.
     *
     * @return string
     *     The result message.
     */
    public function getResultMessage()
    {
        return $this->resultMessage;
    }


    /**
     * Set the message of the result of an Authlete API call.
     *
     * @param string $resultMessage
     *     The result message.
     *
     * @return ApiResponse
     *     `$this` object.
     */
    public function setResultMessage($resultMessage)
    {
        ValidationUtility::ensureNullOrString('$resultMessage', $resultMessage);

        $this->resultMessage = $resultMessage;

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
    public function copyToArray(array &$array):void
    {
        $array['resultCode']    = $this->resultCode;
        $array['resultMessage'] = $this->resultMessage;
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
        // resultCode
        $this->setResultCode(
            LanguageUtility::getFromArray('resultCode', $array));

        // resultMessage
        $this->setResultMessage(
            LanguageUtility::getFromArray('resultMessage', $array));
    }
}
