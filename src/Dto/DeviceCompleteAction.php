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
 * File containing the definition of DeviceCompleteAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/device/complete API.
 *
 * @since 1.8
 */
enum DeviceCompleteAction: string implements Valuable
{
    use EnumTrait;


    /**
     * The API call has been processed successfully. The authorization server
     * should return a successful response to the web browser the end-user is
     * using.
     */
    case SUCCESS = 'success';


    /**
     * The API call is invalid. Probably, the authorization server
     * implementation has some bugs.
     */
    case INVALID_REQUEST = 'invalid_request';


    /**
     * The user code has expired. The authorization server implementation
     * should tell the end-user that the user code has expired and urge her
     * to re-initiate a device flow.
     */
    case USER_CODE_EXPIRED = 'user_code_expired';


    /**
     * The user code does not exist. The authorization server implementation
     * should tell the end-user that the user code has been invalidated and
     * urge her to re-initiate a device flow.
     */
    case USER_CODE_NOT_EXIST = 'user_code_not_exist';


    /**
     * An error occurred on Authlete side. The authorization server
     * implementation should tell the end-user that something wrong happened
     * and urge her to re-initiate a device flow.
     */
    case SERVER_ERROR = 'server_error';
}

