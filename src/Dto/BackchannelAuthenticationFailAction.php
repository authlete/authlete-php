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
 * File containing the definition of BackchannelAuthenticationFailAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/backchannel/authentication/fail API.
 *
 * @since 1.8
 */
enum BackchannelAuthenticationFailAction: string implements Valuable
{
    use EnumTrait;

    /**
     * The implementation of the backchannel authentication endpoint should
     * return a `400 Bad Request` response to the client application.
     */
    case BAD_REQUEST = 'BAD_REQUEST';


    /**
     * The implementation of the backchannel authentication endpoint should
     * return a `403 Forbidden` response to the client application.
     *
     * `BackchannelAuthenticationFailResponse.getAction()` returns this value
     * only when the `reason` request parameter of the API call was
     * `ACCESS_DENIED`.
     */
    case FORBIDDEN = 'FORBIDDEN';


    /**
     * The implementation of the backchannel authentication endpoint should
     * return a `500 Internal Server Error` response to the client application.
     * However, in most cases, commercial implementations prefer to use other
     * HTTP status code than 5xx.
     *
     * `BackchannelAuthenticationFailResponse.getAction()` returns this value
     * when (1) the `reason` request parameter of the API call was
     * `SERVER_ERROR`, (2) an error occurred on Authlete side, or (3) the
     * request parameters of the API call were wrong.
     */
    case INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
}

