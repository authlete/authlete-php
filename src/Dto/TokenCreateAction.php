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
 * File containing the definition of TokenCreateAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's /api/auth/token/create
 * API.
 */
enum TokenCreateAction: string implements Valuable
{
    use EnumTrait;

    /**
     * An error occurred on Authlete side.
     */
    case INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';


    /**
     * The request from your system was wrong.
     *
     * For example, this happens when the `grantType` request parameter is
     * missing.
     */
    case BAD_REQUEST = 'BAD_REQUEST';


    /**
     * The request from your system was not allowed.
     *
     * For example, this happens when the client application identified by
     * the `clientId` request parameter does not belong to the service
     * identified by the API key used for the API call.
     */
    case FORBIDDEN = 'FORBIDDEN';


    /**
     * An access token and optionally a refresh token were issued successfully.
     */
    case OK = 'OK';
}

