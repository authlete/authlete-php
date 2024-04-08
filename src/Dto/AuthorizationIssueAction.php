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
 * File containing the definition of AuthorizationIssueAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Types\Valuable;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's
 * /api/auth/authorization/issue API.
 */
enum AuthorizationIssueAction: string implements Valuable
{
    use EnumTrait;



    /**
     * The request from the authorization server implementation was wrong
     * or an error occurred in Authlete. The authorization server
     * implementation should return "500 Internal Server Error" to the
     * client application.
     */
    case INTERNAL_SERVER_ERROR = 'internal_server_error';


    /**
     * The ticket was no longer valid. The authorization server
     * implementation should return "400 Bad Request" to the client
     * application.
     */
    case BAD_REQUEST = 'bad_request';


    /**
     * The authorization server implementation should return "302 Found"
     * to the client application with a "Location" header.
     */
    case LOCATION = 'location';


    /**
     * The authorization server implementation should return "200 OK" to
     * the client application with an HTML which triggers redirection.
     */
    case FORM = 'form';
}

