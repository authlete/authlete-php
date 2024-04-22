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
 * File containing the definition of DeviceVerificationRequest class.
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
 * Request to Authlete's /api/device/verification API. The API is used to get
 * information associated with a user code.
 *
 * After receiving a response from the device authorization endpoint of the
 * authorization server, the client application shows the end-user the user
 * code and the verification URI which are included in the device authorization
 * response. Then, the end-user will access the verification URI using a web
 * browser on another device (typically, a smart phone). In normal
 * implementations, the verification endpoint will return an HTML page with an
 * input form where the end-user inputs a user code. The authorization server
 * will receive a user code from the form.
 *
 * After receiving a user code, the authorization server should call Authlete's
 * `/api/device/verification` API with the user code. The API will return
 * information associated with the user code such as client information and
 * requested scopes. Using the information, the authorization server should
 * generate an HTML page that confirms the end-user's consent and send the page
 * back to the web browser.
 *
 * @since 1.8
 */
class DeviceVerificationRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private ?string $userCode = null;  // string


    /**
     * Get the user code.
     *
     * @return string|null
     *     The user code.
     */
    public function getUserCode(): ?string
    {
        return $this->userCode;
    }


    /**
     * Set the user code.
     *
     * @param string $code
     *     The user code.
     *
     * @return DeviceVerificationRequest
     *     `$this` object
     */
    public function setUserCode(string $code): DeviceVerificationRequest
    {
        ValidationUtility::ensureNullOrString('$code', $code);

        $this->userCode = $code;

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
        $array['userCode'] = $this->userCode;
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
        // userCode
        $this->setUserCode(
            LanguageUtility::getFromArray('userCode', $array));
    }
}

