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
 * File containing the definition of TokenAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's /api/auth/token API.
 */
enum TokenAction: string implements Valuable
{
    use EnumTrait;


    /**
     * Authentication of the client application failed.
     *
     * The token endpoint implementation should return either
     * `400 Bad Request` or `401 Unauthorized` to the client application.
     */
    case INVALID_CLIENT = 'invalid_client';


    /**
     * The request from your system to Authlete was wrong or an error occurred
     * in Authlete.
     *
     * The token endpoint implementation should return
     * `500 Internal Server Error` to the client application.
     */
    case INTERNAL_SERVER_ERROR = 'internal_server_error';


    /**
     * The token request from the client application was wrong.
     *
     * The token endpoint implementation should return `400 Bad Request` to
     * the client appication.
     */
    case BAD_REQUEST = 'bad_request';


    /**
     * The token request from the client application was valid and the grant
     * type is "password".
     *
     * The token endpoint implementation should validate the credentials of
     * the resource owner and call Authlete's `/api/auth/token/issue` API or
     * `/api/auth/token/fail` API according to the result of the validation.
     */
    case PASSWORD = 'password';


    /**
     * The token request from the client was valid.
     *
     * The token endpoint implementation should return `200 OK` to the client
     * application with an access token.
     */
    case OK = 'ok';
}

