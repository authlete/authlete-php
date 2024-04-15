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
 * File containing the definition of DeviceAuthorizationAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/device/authorization API.
 *
 * @since 1.8
 */
enum DeviceAuthorizationAction: string implements Valuable
{
    use EnumTrait;


    /**
     * The device authorization request is valid. The authorization server
     * implementation should return a successful response with `200 OK` and
     * `application/json` to the client application.
     */
    case OK = 'OK';


    /**
     * The device authorization request is invalid. The authorization server
     * implementation should return an error response with `400 Bad Request`
     * and `application/json` to the client application.
     */
    case BAD_REQUEST = 'BAD_REQUEST';


    /**
     * Client authentication of the device authorization request failed.
     * The authorization server implementation should return an error response
     * with `401 Unauthorized` and `application/json` to the client application.
     */
    case UNAUTHORIZED = 'UNAUTHORIZED';


    /**
     * The API call from the authorization server implementation was wrong or
     * an error occurred on Authlete side. The authorization server
     * implementation should return response with `500 Internal Server Error`
     * and `application/json` to the client application.
     */
    case INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
}

