<?php
//
// Copyright (C) 2018-2024 Authlete, Inc.
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
use Authlete\Util\LanguageUtility;


/**
 * The value of "action" in responses from Authlete's /api/auth/token API.
 */
class TokenAction
{
    use EnumTrait;


    /**
     * Authentication of the client application failed.
     *
     * The token endpoint implementation should return either
     * `400 Bad Request` or `401 Unauthorized` to the client application.
     *
     * @static
     * @var TokenAction
     */
    public static $INVALID_CLIENT;


    /**
     * The request from your system to Authlete was wrong or an error occurred
     * in Authlete.
     *
     * The token endpoint implementation should return
     * `500 Internal Server Error` to the client application.
     *
     * @static
     * @var TokenAction
     */
    public static $INTERNAL_SERVER_ERROR;


    /**
     * The token request from the client application was wrong.
     *
     * The token endpoint implementation should return `400 Bad Request` to
     * the client appication.
     *
     * @static
     * @var TokenAction
     */
    public static $BAD_REQUEST;


    /**
     * The token request from the client application was valid and the grant
     * type is "password".
     *
     * The token endpoint implementation should validate the credentials of
     * the resource owner and call Authlete's `/api/auth/token/issue` API or
     * `/api/auth/token/fail` API according to the result of the validation.
     *
     * @static
     * @var TokenAction
     */
    public static $PASSWORD;


    /**
     * The token request from the client was valid.
     *
     * The token endpoint implementation should return `200 OK` to the client
     * application with an access token.
     *
     * @static
     * @var TokenAction
     */
    public static $OK;


    /**
     * The token request from the client was a valid token exchange request.
     *
     * The token endpoint implementation should take necessary actions (e.g.
     * create an access token), generate a response and return it to the
     * client application.
     *
     * @static
     * @var TokenAction
     * @since 1.13.0
     */
    public static $TOKEN_EXCHANGE;


    /**
     * The token request from the client was a valid token request with the
     * grant type `"urn:ietf:params:oauth:grant-type:jwt-bearer"`.
     *
     * The token endpoint implementation must verify the signature of the
     * assertion, create an access token, generate a response and return it
     * to the client application.
     *
     * @static
     * @var TokenAction
     * @since 1.13.0
     */
    public static $JWT_BEARER;


    /**
     * The token request from the client was a valid token request using
     * the refresh token flow and an ID token can be reissued.
     *
     * The token endpoint implementation can choose either (1) to execute
     * the same steps as for the `$OK` action which results in the same
     * behavior as before, or (2) to call the `/idtoken/reissue` API to
     * reissue a new ID token together with a new access token and a
     * refresh token.
     *
     * @static
     * @var TokenAction
     * @since 1.13.0
     */
    public static $ID_TOKEN_REISSUABLE;
}


// Call TokenAction::initialize().
LanguageUtility::initializeClass(__NAMESPACE__ . '\TokenAction');
?>
