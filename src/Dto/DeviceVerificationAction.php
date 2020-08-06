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
 * File containing the definition of DeviceVerificationAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/device/verification API.
 *
 * @since 1.8
 */
class DeviceVerificationAction
{
    use EnumTrait;


    /**
     * The user code is valid. This means that the user code exists, has not
     * expired, and belongs to the service. The authorization server
     * implementation should interact with the end-user to ask whether she
     * approves or rejects the authorization request from the device.
     *
     * @static
     * @var DeviceVerificationAction
     */
    public static $VALID;


    /**
     * The user code has expired. The authorization server implementation
     * should tell the end-user that the user code has expired and urge her
     * to re-initiate a device flow.
     *
     * @static
     * @var DeviceVerificationAction
     */
    public static $EXPIRED;


    /**
     * The user code does not exist. The authorization server implementation
     * should tell the end-user that the user code is invalid and urge her
     * to retry to input a valid user code.
     *
     * @static
     * @var DeviceVerificationAction
     */
    public static $NOT_EXIST;


    /**
     * An error occurred on Authlete side. The authorization server
     * implementation should tell the end-user that something wrong happened
     * and urge her to re-initiate a device flow.
     *
     * @static
     * @var DeviceVerificationAction
     */
    public static $SERVER_ERROR;
}


// Call DeviceVerificationAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\DeviceVerificationAction');
?>
