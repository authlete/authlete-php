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
 * File containing the definition of RevocationAction class.
 */


namespace Authlete\Dto;


use Authlete\Types\EnumTrait;
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's /api/auth/revocation API.
 */
class RevocationAction
{
    use EnumTrait;


    /**
     * Authentication of the client application failed.
     *
     * The authorization server implementation should return either
     * `400 Bad Request` or `401 Unauthorized` to the client application.
     *
     * @static
     * @var RevocationAction
     */
    public static $INVALID_CLIENT;


    /**
     * The request from the authorization server implementation was wrong
     * or an error occurred in Authlete.
     *
     * The authorization server implementation should return
     * `500 Internal Server Error` to the client application.
     *
     * @static
     * @var RevocationAction
     */
    public static $INTERNAL_SERVER_ERROR;


    /**
     * The request from the client application was wrong.
     *
     * The authorization server implementation should return
     * `400 Bad Request` to the client application.
     *
     * @static
     * @var RevocationAction
     */
    public static $BAD_REQUEST;


    /**
     * The request from the client application was valid.
     *
     * The authorization server implementation should return `200 OK` to
     * the client application.
     *
     * @static
     * @var RevocationAction
     */
    public static $OK;
}


// Call RevocationAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\RevocationAction');
?>
