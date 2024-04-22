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
 * File containing the definition of BackchannelAuthenticationCompleteResult class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;

/**
 * The value of "result" in requests to Authlete's
 * /api/backchannel/authentication/complete API.
 *
 * @since 1.8
 */
enum BackchannelAuthenticationCompleteResult: string implements Valuable
{
    use EnumTrait;


    /**
     * The end-user was authenticated and has granted authorization to the
     * client application.
     */
    case AUTHORIZED = 'AUTHORIZED';


    /**
     * The end-user denied the backchannel authentication request.
     */
    case ACCESS_DENIED = 'ACCESS_DENIED';


    /**
     * The authorization server could not get the result of end-user
     * authentication and authorization from the authentication device
     * for some reasons.
     *
     * For example, the authorization server failed to communicate with
     * the authentication device due to a network error, the device did
     * not return a response within a reasonable time, etc.
     *
     * This result can be used as a generic error.
     */
    case TRANSACTION_FAILED = 'TRANSACTION_FAILED';
}

