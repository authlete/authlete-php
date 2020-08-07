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
 * File containing the definition of DeviceCompleteResponse class.
 */


namespace Authlete\Dto;


use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/device/complete API.
 *
 * Authlete's `/api/device/complete` API returns JSON which can be mapped to
 * this class. The authorization server implementation should retrieve the
 * value of the `action` response parameter (which can be obtained by
 * `getAction()` method of this class) from the response and take the following
 * steps according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceCompleteAction::$SUCCESS`, it means that the API call has been
 * processed successfully. The authorization server should return a successful
 * response to the web browser the end-user is using.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceCompleteAction::$INVALID_REQUEST`, it means that the API call is
 * invalid. Probably, the authorization server implementation has some bugs.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceCompleteAction::$USER_CODE_EXPIRED`, it means that the user code
 * included in the API call has expired. The authorization server
 * implementation should tell the end-user that the user code has expired and
 * urge her to re-initiate a device flow.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceCompleteAction::$USER_CODE_NOT_EXIST`, it means that the user code
 * included in the API call does not exist. The authorization server
 * implementation should tell the end-user that the user code has been
 * invalidated and urge her to re-initiate a device flow.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `DeviceCompleteAction::$SERVER_ERROR`, it means that an error occurred on
 * Authlete side. The authorization server implementation should tell the
 * end-user that something wrong happened and urge her to re-initiate a device
 * flow.
 *
 * @since 1.8
 */
class DeviceCompleteResponse extends ApiResponse
{
    private $action = null;  // \Authlete\Dto\DeviceCompleteAction


    /**
     * Get the next action that the authorization server should take.
     *
     * @return DeviceAuthorizationAction
     *     The next action that the authorization server should take.
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set the next action that the authorization server should take.
     *
     * @param DeviceCompleteAction $action
     *     The next action that the authorization server should take.
     *
     * @return DeviceCompleteResponse
     *     `$this` object.
     */
    public function setAction(DeviceCompleteAction $action = null)
    {
        $this->action = $action;

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
        parent::copyToArray($array);

        $array['action'] = LanguageUtility::toString($this->action);
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
        parent::copyFromArray($array);

        // action
        $this->setAction(
            DeviceCompleteAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));
    }
}
?>
