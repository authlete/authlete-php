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
 * File containing the definition of AuthorizationAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;


/**
 * The value of "action" in responses from Authlete's
 * /api/auth/authorization API.
 */
enum AuthorizationAction implements Valuable
{
    use EnumTrait;


    /**
     * The request from the authorization server implementation was wrong
     * or an error occurred in Authlete. The authorization server
     * implementation should return "500 Internal Server Error" to the
     * client application.
     */
    case INTERNAL_SERVER_ERROR;


    /**
     * The authorization request was wrong and the authorization server
     * implementation should notify the client application of the error
     * by "400 Bad Request".
     */
    case BAD_REQUEST;


    /**
     * The authorization request was wrong and the authorization server
     * implementation should notify the client application of the error
     * by "302 Found".
     */
    case LOCATION;


    /**
     * The authorization request was wrong and the authorization server
     * implementation should notify the client application of the error
     * by "200 OK" with an HTML which triggers redirection by JavaScript.
     *
     * @see https://openid.net/specs/oauth-v2-form-post-response-mode-1_0.html OAuth 2.0 Form Post Response Mode
     */
    case FORM;


    /**
     * The authorization request was valid and the authorization server
     * implementation should issue an authorization code, an ID token
     * and/or an access token without interaction with the end-user.
     */
    case NO_INTERACTION;


    /**
     * The authorization request was valid and the authorization server
     * implementation should display UI to ask for authorization from
     * the end-user.
     */
    case INTERACTION;
}

