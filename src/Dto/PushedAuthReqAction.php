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
 * File containing the definition of PushedAuthReqAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/pushed_auth_req API.
 *
 * @since 1.8
 */
enum PushedAuthReqAction: string implements Valuable
{
    use EnumTrait;

    /**
     * The pushed authorization request has been registered successfully.
     * The endpoint should return `201 Created` to the client application.
     */
    case CREATED = 'created';


    /**
     * The request is invalid. The pushed authorization request endpoint
     * should return `400 Bad Request` to the client application.
     */
    case BAD_REQUEST = 'bad_request';


    /**
     * The client authentication at the pushed authorization request endpoint
     * failed. The endpoint should return `401 Unauthorized` to the client
     * application.
     */
    case UNAUTHORIZED = 'unauthorized';


    /**
     * The client application is not allowed to use the pushed authorization
     * request endpoint. The endpoint should return `403 Forbidden` to the
     * client application.
     */
    case FORBIDDEN = 'forbidden';


    /**
     * The size of the pushed authorization request is too large. The endpoint
     * should return `413 Payload Too Large` to the client application.
     */
    case PAYLOAD_TOO_LARGE = 'payload_too_large';


    /**
     * The API call was wrong or an error occurred on Authlete side. The pushed
     * authorization request endpoint should return `500 Internal Server Error`
     * to the client application. However, it is up to the authorization
     * server's policy whether to return `500` actually.
     */
    case INTERNAL_SERVER_ERROR = 'internal_server_error';
}

