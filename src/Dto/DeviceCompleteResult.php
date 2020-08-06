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
 * File containing the definition of DeviceCompleteResult class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "result" in requests to Authlete's
 * /api/device/complete API.
 *
 * @since 1.8
 */
class DeviceCompleteResult
{
    use EnumTrait;


    /**
     * The end-user was authenticated and has granted authorization to the
     * client application.
     *
     * @static
     * @var DeviceCompleteResult
     */
    public static $AUTHORIZED;


    /**
     * The end-user denied the device authorization request.
     *
     * @static
     * @var DeviceCompleteResult
     */
    public static $ACCESS_DENIED;


    /**
     * The authorization server could not get decision from the end-user
     * for some reasons.
     *
     * This result can be used as a generic error.
     *
     * @static
     * @var DeviceCompleteResult
     */
    public static $TRANSACTION_FAILED;
}


// Call DeviceCompleteResult::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\DeviceCompleteResult');
?>
